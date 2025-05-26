import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class TanggalHaid extends StatefulWidget {
  const TanggalHaid({super.key});

  @override
  State<TanggalHaid> createState() => _TanggalHaidState();
}

class _TanggalHaidState extends State<TanggalHaid> {
  DateTime? selectedHaidDate;

  @override
  Widget build(BuildContext context) {
    final now = DateTime.now();
    final dateFormat = DateFormat('EEEE, d MMMM y', 'id_ID');

    bool isHaid(DateTime date) {
      if (selectedHaidDate == null) return false;
      final endHaid = selectedHaidDate!.add(const Duration(days: 6));
      return date
          .isAfter(selectedHaidDate!.subtract(const Duration(days: 1))) &&
          date.isBefore(endHaid.add(const Duration(days: 1)));
    }

    return Column(
      children: [
        const SizedBox(height: 20),
        ElevatedButton(
          onPressed: () async {
            final pickedDate = await showDatePicker(
              context: context,
              initialDate: selectedHaidDate ?? DateTime.now(),
              firstDate: DateTime(2000),
              lastDate: DateTime(2100),
              locale: const Locale('id', 'ID'),
            );
            if (pickedDate != null) {
              setState(() {
                selectedHaidDate = pickedDate;
              });
            }
          },
          style: ElevatedButton.styleFrom(
            backgroundColor: const Color.fromARGB(255, 233, 30, 99),
            foregroundColor: Colors.white,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(8),
            ),
            elevation: 2,
            padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
          ),
          child: const Text(
            "Pilih Tanggal Haid",
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 14,
            ),
          ),
        ),
        const SizedBox(height: 20),
        Container(
          padding: const EdgeInsets.all(12),
          margin: const EdgeInsets.symmetric(horizontal: 40),
          decoration: BoxDecoration(
            color: Colors.grey.withOpacity(0.1), // warna abu-abu
            borderRadius: BorderRadius.circular(12),
          ),
          child: _buildTanggalTile(
            "Hari Ini",
            dateFormat.format(now),
            isHaid(now),
          ),
        ),
      ],
    );
  }

  Widget _buildTanggalTile(String label, String tanggal, bool isHaidFase) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        // Kiri: Tanggal dan Label
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: const TextStyle(
                  color: Color.fromARGB(255, 233, 30, 99),
                  fontSize: 14,
                  fontWeight: FontWeight.w600,
                ),
              ),
              const SizedBox(height: 4),
              Text(
                tanggal,
                style: const TextStyle(
                  color: Color.fromARGB(221, 0, 0, 0),
                  fontSize: 14,
                ),
              ),
            ],
          ),
        ),
        // Kanan: Fase Haid
        if (isHaidFase)
          const Column(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: [
              Text(
                "Fase Haid",
                style: TextStyle(
                  color: Color.fromARGB(255, 233, 30, 99),
                  fontSize: 14,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
      ],
    );
  }
}
