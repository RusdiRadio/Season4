import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class PrediksiPage extends StatefulWidget {
  const PrediksiPage({Key? key}) : super(key: key);

  @override
  State<PrediksiPage> createState() => _PrediksiPageState();
}

class _PrediksiPageState extends State<PrediksiPage> {
  final TextEditingController _usiaController = TextEditingController();
  final TextEditingController _beratController = TextEditingController();
  final TextEditingController _tinggiController = TextEditingController();
  final TextEditingController _bmiController = TextEditingController();
  final TextEditingController _lingkarPinggangController = TextEditingController();
  final TextEditingController _lingkarPanggulController = TextEditingController();

  String? _beratBadan;
  String? _rambutTidakWajar;
  String? _kulitGelap;
  String? _rontok;
  String? _jerawat;
  String? _junkFood;
  String? _haidTeratur;

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  Future<void> _submitData() async {
    if (_formKey.currentState!.validate()) {
      final Map<String, dynamic> data = {
        "id_user": 1, // Ganti sesuai kebutuhan
        "nama": "Nama Pengguna",
        "Umur": int.parse(_usiaController.text),
        "Berat_kg": double.parse(_beratController.text),
        "Tinggi_cm": double.parse(_tinggiController.text),
        "Siklus_Haid": _haidTeratur == "ya" ? 1 : 0,
        "Lingkar_Panggul_cm": double.parse(_lingkarPanggulController.text),
        "Lingkar_Pinggang_cm": double.parse(_lingkarPinggangController.text),
        "Kenaikan_BB": _beratBadan == "ya",
        "Pertumbuhan_Rambut_di_Area_Tidak_Wajar": _rambutTidakWajar == "ya",
        "Penggelapan_Kulit_di_Area_Lipatan": _kulitGelap == "ya",
        "Kerontokan_Rambut": _rontok == "ya",
        "Jerawat": _jerawat == "ya",
        "Sering_Makan_FastFood": _junkFood == "ya",
        "BMI": double.parse(_bmiController.text),
      };

      try {
        final response = await http.post(
        Uri.parse("http://localhost:8000/api/predict-pcos"),
          headers: {
            'Content-Type': 'application/json',
          },
          body: jsonEncode(data),
        );

        if (response.statusCode == 200) {
          final result = jsonDecode(response.body);
          showDialog(
            context: context,
            builder: (context) => AlertDialog(
              title: Text("Hasil Prediksi"),
              content: Text("Status: ${result['prediction_result']['status']}\nEdukasi: ${result['prediction_result']['edukasi']}"),
              actions: [
                TextButton(
                  onPressed: () => Navigator.pop(context),
                  child: Text("OK"),
                ),
              ],
            ),
          );
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text("Gagal memproses prediksi dari server.")),
          );
        }
      } catch (e) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Terjadi kesalahan: $e")),
        );
      }
    }
  }

  Widget _buildInputField(
    String label,
    TextEditingController controller, {
    Widget? suffix,
    IconData? icon,
  }) {
    return TextFormField(
      controller: controller,
      style: const TextStyle(color: Colors.black),
      decoration: InputDecoration(
        prefixIcon: icon != null
            ? Icon(icon, color: const Color.fromARGB(255, 233, 30, 99))
            : null,
        labelText: label,
        filled: true,
        fillColor: Colors.grey.withOpacity(0.1),
        suffix: suffix,
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
      ),
      validator: (value) => value == null || value.isEmpty ? 'Tidak boleh kosong' : null,
      keyboardType: TextInputType.numberWithOptions(decimal: true),
    );
  }

  Widget _buildDropdownField(
    String label,
    String? value,
    Function(String?) onChanged, {
    IconData? icon,
  }) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(
        prefixIcon: icon != null
            ? Icon(icon, color: const Color.fromARGB(255, 233, 30, 99))
            : null,
        labelText: label,
        filled: true,
        fillColor: Colors.grey.withOpacity(0.1),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
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
      backgroundColor: const Color.fromARGB(255, 255, 255, 255),
      appBar: AppBar(
        backgroundColor: const Color.fromARGB(255, 255, 118, 205),
        centerTitle: true,
        elevation: 0,
        title: Text(
          "Form Klasifikasi PCOS",
          style: GoogleFonts.poppins(
            fontSize: 20,
            fontWeight: FontWeight.w600,
            color: Colors.white,
          ),
        ),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Padding(
            padding: const EdgeInsets.all(16),
            child: Center(
              child: ConstrainedBox(
                constraints: const BoxConstraints(maxWidth: 500),
                child: Form(
                  key: _formKey,
                  child: Column(
                    children: [
                      _buildInputField("Usia (tahun)", _usiaController, icon: Icons.cake),
                      const SizedBox(height: 12),
                      _buildInputField("Berat badan (kg)", _beratController, suffix: const Padding(padding: EdgeInsets.only(right: 10), child: Text("kg", style: TextStyle(color: Colors.grey))), icon: Icons.monitor_weight),
                      const SizedBox(height: 12),
                      _buildInputField("Tinggi badan (cm)", _tinggiController, suffix: const Padding(padding: EdgeInsets.only(right: 10), child: Text("cm", style: TextStyle(color: Colors.grey))), icon: Icons.height),
                      const SizedBox(height: 12),
                      _buildInputField("BMI (diisi manual)", _bmiController, suffix: const Padding(padding: EdgeInsets.only(right: 10), child: Text("kg/m²", style: TextStyle(color: Colors.grey))), icon: Icons.fitness_center),
                      const SizedBox(height: 12),
                      _buildInputField("Lingkar pinggang (cm)", _lingkarPinggangController, suffix: const Padding(padding: EdgeInsets.only(right: 10), child: Text("cm", style: TextStyle(color: Colors.grey))), icon: Icons.straighten),
                      const SizedBox(height: 12),
                      _buildInputField("Lingkar panggul (cm)", _lingkarPanggulController, suffix: const Padding(padding: EdgeInsets.only(right: 10), child: Text("cm", style: TextStyle(color: Colors.grey))), icon: Icons.straighten),
                      const SizedBox(height: 12),
                      _buildDropdownField("Apakah Haid teratur?", _haidTeratur, (val) => setState(() => _haidTeratur = val), icon: Icons.calendar_month),
                      const SizedBox(height: 12),
                      _buildDropdownField("Kenaikan berat badan", _beratBadan, (val) => setState(() => _beratBadan = val), icon: Icons.monitor_weight),
                      const SizedBox(height: 12),
                      _buildDropdownField("Pertumbuhan rambut tidak wajar", _rambutTidakWajar, (val) => setState(() => _rambutTidakWajar = val), icon: Icons.face_retouching_natural),
                      const SizedBox(height: 12),
                      _buildDropdownField("Penggelapan kulit di area tidak wajar", _kulitGelap, (val) => setState(() => _kulitGelap = val), icon: Icons.invert_colors),
                      const SizedBox(height: 12),
                      _buildDropdownField("Kerontokan rambut", _rontok, (val) => setState(() => _rontok = val), icon: Icons.cut),
                      const SizedBox(height: 12),
                      _buildDropdownField("Jerawat", _jerawat, (val) => setState(() => _jerawat = val), icon: Icons.bubble_chart),
                      const SizedBox(height: 12),
                      _buildDropdownField("Sering makan junk food", _junkFood, (val) => setState(() => _junkFood = val), icon: Icons.fastfood),
                      const SizedBox(height: 24),
                      ElevatedButton.icon(
                        onPressed: _submitData,
                        icon: const Icon(Icons.check),
                        label: const Text("Kirim dan Prediksi"),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color.fromARGB(255, 255, 118, 205),
                          foregroundColor: Colors.white,
                          padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                          textStyle: const TextStyle(fontSize: 16),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
<<<<<<< Updated upstream
                          const SizedBox(height: 12),
                          _buildInputField("Lingkar pinggang (cm)",
                              _lingkarPinggangController,
                              suffix: const Padding(
                                padding: EdgeInsets.only(right: 10),
                                child: Text("cm",
                                    style: TextStyle(color: Colors.grey)),
                              ),
                              icon: Icons.straighten),
                          const SizedBox(height: 12),
                          _buildInputField(
                              "Lingkar panggul (cm)", _lingkarPanggulController,
                              suffix: const Padding(
                                padding: EdgeInsets.only(right: 10),
                                child: Text("cm",
                                    style: TextStyle(color: Colors.grey)),
                              ),
                              icon: Icons.straighten),
                          const SizedBox(height: 12),
                          _buildDropdownField(
                              "Apakah Haid teratur?",
                              _haidTeratur,
                              (val) => setState(() => _haidTeratur = val),
                              icon: Icons.calendar_month),
                          const SizedBox(height: 12),
                          _buildDropdownField(
                              "Kenaikan berat badan",
                              _beratBadan,
                              (val) => setState(() => _beratBadan = val),
                              icon: Icons.monitor_weight),
                          const SizedBox(height: 12),
                          _buildDropdownField(
                              "Pertumbuhan rambut tidak wajar",
                              _rambutTidakWajar,
                              (val) => setState(() => _rambutTidakWajar = val),
                              icon: Icons.face_retouching_natural),
                          const SizedBox(height: 12),
                          _buildDropdownField(
                              "Penggelapan kulit di area tidak wajar",
                              _kulitGelap,
                              (val) => setState(() => _kulitGelap = val),
                              icon: Icons.dark_mode),
                          const SizedBox(height: 12),
                          _buildDropdownField("Kerontokan rambut", _rontok,
                              (val) => setState(() => _rontok = val),
                              icon: Icons.content_cut),
                          const SizedBox(height: 12),
                          _buildDropdownField("Jerawat", _jerawat,
                              (val) => setState(() => _jerawat = val),
                              icon: Icons.sick),
                          const SizedBox(height: 12),
                          _buildDropdownField(
                              "Makan makanan junk food?",
                              _junkFood,
                              (val) => setState(() => _junkFood = val),
                              icon: Icons.fastfood),
                          const SizedBox(height: 12),
                          _buildDropdownField("Pertumbuhan rambut berlebih",
                              _rambut, (val) => setState(() => _rambut = val),
                              icon: Icons.face),
                          const SizedBox(height: 20),
                          ElevatedButton(
                            onPressed: _addData,
                            style: ElevatedButton.styleFrom(
                              backgroundColor:
                                  const Color.fromARGB(255, 233, 30, 99),
                              minimumSize: const Size.fromHeight(50),
                            ),
                            child: Text(
                              "Prediksi sekarang!",
                              style: GoogleFonts.poppins(
                                  fontSize: 18,
                                  fontWeight: FontWeight.w600,
                                  color: Colors.white),
                            ),
                          ),
                          const SizedBox(height: 20),
                        ],
=======
                        ),
>>>>>>> Stashed changes
                      ),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
