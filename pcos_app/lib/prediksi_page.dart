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
  final TextEditingController _rambutController = TextEditingController();
  final TextEditingController _lingkarController = TextEditingController();

  String? _rambut;
  String? _beratBadan;
  String? _rambutTidakWajar;
  String? _kulitGelap;
  String? _rontok;
  String? _jerawat;
  String? _junkFood;

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  DateTime? _selectedDate;
  String? _tanggalSelesai;

  void _pickDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2000),
      lastDate: DateTime(2100),
    );

    if (picked != null) {
      setState(() {
        _selectedDate = picked;
        final selesai = picked.add(const Duration(days: 7));
        _tanggalSelesai = "${selesai.day}/${selesai.month}/${selesai.year}";
      });
    }
  }

  void _addData() {
    if (_formKey.currentState!.validate() && _selectedDate != null) {
      setState(() {
        _dataList.add({
          'usia': _usiaController.text,
          'siklus':
              "${_selectedDate!.day}/${_selectedDate!.month}/${_selectedDate!.year} - $_tanggalSelesai",
          'rambut': _rambut,
          'lingkar': _lingkarController.text,
          'kenaikan_berat': _beratBadan,
          'rambut_tidak_wajar': _rambutTidakWajar,
          'kulit_gelap': _kulitGelap,
          'kerontokan': _rontok,
          'jerawat': _jerawat,
          'junk_food': _junkFood,
        });

        _usiaController.clear();
        _rambutController.clear();
        _lingkarController.clear();
        _beratBadan = null;
        _rambutTidakWajar = null;
        _kulitGelap = null;
        _rontok = null;
        _jerawat = null;
        _junkFood = null;
        _selectedDate = null;
        _tanggalSelesai = null;
      });
    }
  }

  Widget _buildInputField(String label, TextEditingController controller,
      {Widget? suffix}) {
    return TextFormField(
      controller: controller,
      style: const TextStyle(color: Colors.black),
      decoration: InputDecoration(
        labelText: label,
        filled: true,
        fillColor: Colors.white,
        suffix: suffix,
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
      ),
      validator: (value) =>
          value == null || value.isEmpty ? 'Tidak boleh kosong' : null,
    );
  }

  Widget _buildDropdownField(String label, String? value, Function(String?) onChanged) {
    return DropdownButtonFormField<String>(
      value: value,
      decoration: InputDecoration(
        labelText: label,
        filled: true,
        fillColor: Colors.white,
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
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        title: const Text("Form Klasifikasi PCOS"),
        backgroundColor: Colors.transparent,
        elevation: 0,
        foregroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [Color(0xFFFFE4E1), Color.fromARGB(255, 255, 83, 112)],
          ),
        ),
        child: SafeArea(
          child: SingleChildScrollView(
            child: ConstrainedBox(
              constraints: BoxConstraints(
                minHeight: MediaQuery.of(context).size.height -
                    MediaQuery.of(context).padding.top,
              ),
              child: Padding(
                padding: const EdgeInsets.all(16),
                child: Column(
                  children: [
                    const SizedBox(height: 16),
                    Form(
                      key: _formKey,
                      child: Column(
                        children: [
                          _buildInputField("Usia (tahun)", _usiaController),
                          const SizedBox(height: 12),
                          GestureDetector(
                            onTap: () => _pickDate(context),
                            child: AbsorbPointer(
                              child: TextFormField(
                                decoration: InputDecoration(
                                  labelText: _selectedDate == null
                                      ? "Pilih tanggal mulai haid"
                                      : "Mulai: ${_selectedDate!.day}/${_selectedDate!.month}/${_selectedDate!.year}\n"
                                          "Selesai: $_tanggalSelesai",
                                  filled: true,
                                  fillColor: Colors.white,
                                  border: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(12),
                                    borderSide: BorderSide.none,
                                  ),
                                ),
                                validator: (_) => _selectedDate == null
                                    ? 'Pilih tanggal mulai haid'
                                    : null,
                              ),
                            ),
                          ),
                          const SizedBox(height: 12),
                           _buildDropdownField("Pertumbuhan rambut berlebih", _rambut,
                               (val) => setState(() => _rambut = val)),
                          const SizedBox(height: 12),
                          _buildInputField(
                            "Lingkar pinggang & panggul",
                            _lingkarController,
                            suffix: const Padding(
                              padding: EdgeInsets.only(right: 10),
                              child: Text("cm", style: TextStyle(color: Colors.grey)),
                            ),
                          ),
                          const SizedBox(height: 12),
                          _buildDropdownField("Kenaikan berat badan", _beratBadan,
                              (val) => setState(() => _beratBadan = val)),
                          const SizedBox(height: 12),
                          _buildDropdownField("Pertumbuhan rambut tidak wajar", _rambutTidakWajar,
                              (val) => setState(() => _rambutTidakWajar = val)),
                          const SizedBox(height: 12),
                          _buildDropdownField("Penggelapan kulit di area tidak wajar", _kulitGelap,
                              (val) => setState(() => _kulitGelap = val)),
                          const SizedBox(height: 12),
                          _buildDropdownField("Kerontokan rambut", _rontok,
                              (val) => setState(() => _rontok = val)),
                          const SizedBox(height: 12),
                          _buildDropdownField("Jerawat", _jerawat,
                              (val) => setState(() => _jerawat = val)),
                          const SizedBox(height: 12),
                          _buildDropdownField("Makan makanan junk food?", _junkFood,
                              (val) => setState(() => _junkFood = val)),
                          const SizedBox(height: 16),
                          ElevatedButton.icon(
                            onPressed: _addData,
                            icon: const Icon(Icons.add, color: Colors.pink),
                            label: const Text("Tambah Data",
                                style: TextStyle(color: Colors.pink)),
                            style: ElevatedButton.styleFrom(
                              backgroundColor: Colors.white,
                              foregroundColor: Colors.pink,
                            ),
                          ),
                        ],
                      ),
                    ),
                    const SizedBox(height: 32),
                    if (_dataList.isNotEmpty)
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            'Data Terkumpul:',
                            style: TextStyle(fontSize: 18, color: Colors.white),
                          ),
                          const SizedBox(height: 12),
                          ..._dataList.map((data) => Card(
                                color: Colors.white.withOpacity(0.9),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(12),
                                ),
                                child: ListTile(
                                  title: Text("Usia: ${data['usia']}"),
                                  subtitle: Text(
                                    "Siklus: ${data['siklus']}\n"
                                    "Rambut berlebih: ${data['rambut']}\n"
                                    "Lingkar: ${data['lingkar']} cm\n"
                                    "Kenaikan berat: ${data['kenaikan_berat']}\n"
                                    "Rambut tidak wajar: ${data['rambut_tidak_wajar']}\n"
                                    "Kulit gelap: ${data['kulit_gelap']}\n"
                                    "Kerontokan: ${data['kerontokan']}\n"
                                    "Jerawat: ${data['jerawat']}\n"
                                    "Junk food: ${data['junk_food']}",
                                  ),
                                  isThreeLine: true,
                                  trailing: IconButton(
                                    icon: const Icon(Icons.delete,
                                        color: Colors.red),
                                    onPressed: () {
                                      setState(() {
                                        _dataList.remove(data);
                                      });
                                    },
                                  ),
                                ),
                              )),
                        ],
                      )
                    else
                      const Text(
                        "Belum ada data yang dimasukkan.",
                        style: TextStyle(color: Colors.white),
                      ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
