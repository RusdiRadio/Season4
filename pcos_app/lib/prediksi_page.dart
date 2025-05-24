import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class PrediksiPage extends StatefulWidget {
  const PrediksiPage({super.key});

  @override
  State<PrediksiPage> createState() => _PrediksiPageState();
}

class _PrediksiPageState extends State<PrediksiPage> {
  final List<Map<String, dynamic>> _dataList = [];

  final TextEditingController _usiaController = TextEditingController();
  final TextEditingController _lingkarController = TextEditingController();

  String? _rambut;
  String? _beratBadan;
  String? _rambutTidakWajar;
  String? _kulitGelap;
  String? _rontok;
  String? _jerawat;
  String? _junkFood;
  String? _haidTeratur;

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  void _addData() {
    if (_formKey.currentState!.validate()) {
      setState(() {
        _dataList.add({
          'usia': _usiaController.text,
          'lingkar': _lingkarController.text,
          'rambut': _rambut,
          'kenaikan_berat': _beratBadan,
          'rambut_tidak_wajar': _rambutTidakWajar,
          'kulit_gelap': _kulitGelap,
          'kerontokan': _rontok,
          'jerawat': _jerawat,
          'junk_food': _junkFood,
          'haid': _haidTeratur,
        });

        _usiaController.clear();
        _lingkarController.clear();
        _rambut = null;
        _beratBadan = null;
        _rambutTidakWajar = null;
        _kulitGelap = null;
        _rontok = null;
        _jerawat = null;
        _junkFood = null;
        _haidTeratur = null;

        _formKey.currentState!.reset();
      });
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
        prefixIcon: icon != null ? Icon(icon, color: Colors.black87) : null,
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
    );
  }

  Widget _buildDropdownField(String label, String? value, Function(String?) onChanged,
      {IconData? icon}) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(
        prefixIcon: icon != null ? Icon(icon, color: Colors.black87) : null,
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
            child: Column(
              children: [
                Center(
                  child: ConstrainedBox(
                    constraints: const BoxConstraints(maxWidth: 500),
                    child: Form(
                      key: _formKey,
                      child: Column(
                        children: [
                          _buildInputField("Usia (tahun)", _usiaController, icon: Icons.cake),
                          const SizedBox(height: 12),
                          _buildInputField(
                            "Lingkar pinggang & panggul",
                            _lingkarController,
                            suffix: const Padding(
                              padding: EdgeInsets.only(right: 10),
                              child: Text("cm", style: TextStyle(color: Colors.grey)),
                            ),
                            icon: Icons.straighten,
                          ),
                          const SizedBox(height: 12),
                          _buildDropdownField("Apakah Haid teratur?", _haidTeratur,
                              (val) => setState(() => _haidTeratur = val),
                              icon: Icons.calendar_month),
                          const SizedBox(height: 12),
                          _buildDropdownField("Kenaikan berat badan", _beratBadan,
                              (val) => setState(() => _beratBadan = val),
                              icon: Icons.monitor_weight),
                          const SizedBox(height: 12),
                          _buildDropdownField("Pertumbuhan rambut tidak wajar", _rambutTidakWajar,
                              (val) => setState(() => _rambutTidakWajar = val),
                              icon: Icons.face_retouching_natural),
                          const SizedBox(height: 12),
                          _buildDropdownField("Penggelapan kulit di area tidak wajar", _kulitGelap,
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
                          _buildDropdownField("Makan makanan junk food?", _junkFood,
                              (val) => setState(() => _junkFood = val),
                              icon: Icons.fastfood),
                          const SizedBox(height: 12),
                          _buildDropdownField("Pertumbuhan rambut berlebih", _rambut,
                              (val) => setState(() => _rambut = val),
                              icon: Icons.face),
                          const SizedBox(height: 16),
                          ElevatedButton.icon(
                            onPressed: _addData,
                            icon: const Icon(Icons.add, color: Colors.white),
                            label: const Text("Tambah Data", style: TextStyle(color: Colors.white)),
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color.fromARGB(255, 233, 30, 99),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 32),
                if (_dataList.isNotEmpty)
                  Center(
                    child: ConstrainedBox(
                      constraints: const BoxConstraints(maxWidth: 350),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            'Data Terkumpul:',
                            style: TextStyle(fontSize: 18, color: Colors.black),
                          ),
                          const SizedBox(height: 12),
                          ..._dataList.map((data) => Card(
                                 color: Colors.grey.withOpacity(0.1),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(12),
                                ),
                                child: ListTile(
                                  title: Text("Usia: ${data['usia']}"),
                                  subtitle: Text(
                                    "Rambut berlebih: ${data['rambut']}\n"
                                    "Lingkar: ${data['lingkar']} cm\n"
                                    "Kenaikan berat: ${data['kenaikan_berat']}\n"
                                    "Rambut tidak wajar: ${data['rambut_tidak_wajar']}\n"
                                    "Kulit gelap: ${data['kulit_gelap']}\n"
                                    "Kerontokan: ${data['kerontokan']}\n"
                                    "Jerawat: ${data['jerawat']}\n"
                                    "Junk food: ${data['junk_food']}\n"
                                    "Haid Teratur: ${data['haid']}\n",
                                  ),
                                  isThreeLine: true,
                                  trailing: IconButton(
                                    icon: const Icon(Icons.delete, color: Colors.red),
                                    onPressed: () {
                                      setState(() {
                                        _dataList.remove(data);
                                      });
                                    },
                                  ),
                                ),
                              )),
                        ],
                      ),
                    ),
                  )
                else
                  const Text(
                    "Belum ada data yang dimasukkan.",
                    style: TextStyle(color: Colors.black),
                  ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
