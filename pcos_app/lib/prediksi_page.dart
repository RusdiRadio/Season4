import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class PrediksiPage extends StatefulWidget {
  const PrediksiPage({super.key});

  @override
  State<PrediksiPage> createState() => _PrediksiPageState();
}

class _PrediksiPageState extends State<PrediksiPage> {
  final TextEditingController usiaController = TextEditingController();
  final TextEditingController beratController = TextEditingController();
  final TextEditingController tinggiController = TextEditingController();
  final TextEditingController bmiController = TextEditingController();
  final TextEditingController siklusController = TextEditingController();
  final TextEditingController folikelKananController = TextEditingController();
  final TextEditingController folikelKiriController = TextEditingController();

  String? haidTeratur;
  String? jerawat;
  String? rambutBerlebih;
  String? rambutTidakWajar;
  String? kulitGelap;
  String? junkFood;
  String? olahraga;

  final _formKey = GlobalKey<FormState>();

  Future<void> submit() async {
    if (_formKey.currentState!.validate()) {
      try {
        final response = await http.post(
          Uri.parse('http://localhost:8000/api/predict'), // Ganti sesuai IP server
          headers: {'Content-Type': 'application/json'},
          body: jsonEncode({
            "age": int.parse(usiaController.text),
            "weight": double.parse(beratController.text),
            "height": double.parse(tinggiController.text),
            "bmi": double.parse(bmiController.text),
            "cycle_length": int.parse(siklusController.text),
            "irregular_periods": haidTeratur == "tidak" ? true : false,
            "acne": jerawat == "ya" ? true : false,
            "hair_growth": rambutBerlebih == "ya" ? true : false,
            "skin_darkening": kulitGelap == "ya" ? true : false,
            "fast_food": junkFood == "ya" ? true : false,
            "exercise": olahraga == "ya" ? true : false,
            "follicle_no_r": int.parse(folikelKananController.text),
            "follicle_no_l": int.parse(folikelKiriController.text),
          }),
        );

        final result = jsonDecode(response.body);
        if (response.statusCode == 200) {
          showDialog(
            context: context,
            builder: (_) => AlertDialog(
              title: const Text("Hasil Prediksi"),
              content: Text(result["status"]),
              actions: [
                TextButton(
                  onPressed: () => Navigator.pop(context),
                  child: const Text("OK"),
                )
              ],
            ),
          );
        } else {
          throw Exception(result["error"] ?? "Terjadi kesalahan");
        }
      } catch (e) {
        showDialog(
          context: context,
          builder: (_) => AlertDialog(
            title: const Text("Error"),
            content: Text(e.toString()),
            actions: [
              TextButton(
                onPressed: () => Navigator.pop(context),
                child: const Text("OK"),
              )
            ],
          ),
        );
      }
    }
  }

  Widget input(String label, TextEditingController controller, {String? satuan}) {
    return TextFormField(
      controller: controller,
      keyboardType: TextInputType.number,
      decoration: InputDecoration(
        labelText: label,
        suffixText: satuan,
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      ),
      validator: (val) => val == null || val.isEmpty ? "Wajib diisi" : null,
    );
  }

  Widget dropdown(String label, String? value, Function(String?) onChanged) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(
        labelText: label,
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      ),
      items: const [
        DropdownMenuItem(value: "ya", child: Text("Ya")),
        DropdownMenuItem(value: "tidak", child: Text("Tidak")),
      ],
      onChanged: onChanged,
      validator: (val) => val == null ? "Pilih salah satu" : null,
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Form Prediksi PCOS", style: GoogleFonts.poppins(color: Colors.white)),
        backgroundColor: const Color(0xFFFF76CD),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              input("Usia", usiaController),
              const SizedBox(height: 10),
              input("Berat Badan", beratController, satuan: "kg"),
              const SizedBox(height: 10),
              input("Tinggi Badan", tinggiController, satuan: "cm"),
              const SizedBox(height: 10),
              input("BMI", bmiController),
              const SizedBox(height: 10),
              input("Panjang Siklus", siklusController, satuan: "hari"),
              const SizedBox(height: 10),
              input("Jumlah Folikel Kanan", folikelKananController),
              const SizedBox(height: 10),
              input("Jumlah Folikel Kiri", folikelKiriController),
              const SizedBox(height: 10),
              dropdown("Haid Teratur?", haidTeratur, (val) => setState(() => haidTeratur = val)),
              const SizedBox(height: 10),
              dropdown("Jerawat?", jerawat, (val) => setState(() => jerawat = val)),
              const SizedBox(height: 10),
              dropdown("Pertumbuhan Rambut Berlebih?", rambutBerlebih, (val) => setState(() => rambutBerlebih = val)),
              const SizedBox(height: 10),
              dropdown("Penggelapan Kulit?", kulitGelap, (val) => setState(() => kulitGelap = val)),
              const SizedBox(height: 10),
              dropdown("Sering Makan Junk Food?", junkFood, (val) => setState(() => junkFood = val)),
              const SizedBox(height: 10),
              dropdown("Olahraga?", olahraga, (val) => setState(() => olahraga = val)),
              const SizedBox(height: 20),
              ElevatedButton(
                onPressed: submit,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFFE91E63),
                  padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 12),
                ),
                child: const Text("Kirim Prediksi", style: TextStyle(color: Colors.white)),
              )
            ],
          ),
        ),
      ),
    );
  }
}
