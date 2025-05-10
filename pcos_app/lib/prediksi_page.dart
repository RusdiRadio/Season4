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
        final selesai = picked.add(const Duration(days: 7)); // default 7 hari
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
          'rambut': _rambutController.text,
        });
        _usiaController.clear();
        _rambutController.clear();
        _selectedDate = null;
        _tanggalSelesai = null;
      });
    }
  }

  Widget _buildInputField(String label, TextEditingController controller) {
    return TextFormField(
      controller: controller,
      style: const TextStyle(color: Colors.black),
      decoration: InputDecoration(
        labelText: label,
        labelStyle: const TextStyle(color: Colors.black),
        filled: true,
        fillColor: Colors.white,
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
      ),
      validator: (value) =>
          value == null || value.isEmpty ? 'Tidak boleh kosong' : null,
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
                                  labelStyle:
                                      const TextStyle(color: Colors.black),
                                  filled: true,
                                  fillColor: Colors.white,
                                  border: OutlineInputBorder(
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                ),
                                validator: (_) => _selectedDate == null
                                    ? 'Pilih tanggal mulai haid'
                                    : null,
                              ),
                            ),
                          ),
                          const SizedBox(height: 12),
                          _buildInputField(
                              "Pertumbuhan rambut berlebih (ya/tidak)",
                              _rambutController),
                          const SizedBox(height: 16),
                          ElevatedButton.icon(
                            onPressed: _addData,
                            icon: const Icon(Icons.add),
                            label: const Text("Tambah Data"),
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color(0xFFF06A8D),
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
                                      "Siklus: ${data['siklus']}\nRambut berlebih: ${data['rambut']}"),
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
