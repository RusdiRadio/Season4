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
    final yesterday = now.subtract(const Duration(days: 1));
    final tomorrow = now.add(const Duration(days: 1));
    final dateFormat = DateFormat('EEEE, d MMMM y', 'id_ID');

    // Cek apakah tanggal hari ini masuk fase haid (anggap durasi haid 7 hari)
    bool isHaid(DateTime date) {
      if (selectedHaidDate == null) return false;
      final endHaid = selectedHaidDate!.add(const Duration(days: 6));
      return date
              .isAfter(selectedHaidDate!.subtract(const Duration(days: 1))) &&
          date.isBefore(endHaid.add(const Duration(days: 1)));
    }

    return Column(
      children: [
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
          child: const Text("Pilih Tanggal Haid"),
        ),
        const SizedBox(height: 10),
        Align(
          alignment: Alignment.topCenter,
          child: Padding(
            padding: const EdgeInsets.only(top: 10),
            child: SingleChildScrollView(
              scrollDirection: Axis.horizontal,
              padding: const EdgeInsets.symmetric(horizontal: 16),
              child: Row(
                children: [
                  _buildTanggalTile("Kemarin", dateFormat.format(yesterday),
                      isHaid(yesterday)),
                  const SizedBox(width: 12),
                  _buildTanggalTile(
                      "Hari Ini", dateFormat.format(now), isHaid(now)),
                  const SizedBox(width: 12),
                  _buildTanggalTile(
                      "Besok", dateFormat.format(tomorrow), isHaid(tomorrow)),
                ],
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildTanggalTile(String label, String tanggal, bool isHaidFase) {
    return Container(
      width: 180,
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.white30),
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          if (isHaidFase)
            const Text(
              "Fase Haid",
              style: TextStyle(
                color: Colors.pinkAccent,
                fontSize: 12,
                fontWeight: FontWeight.bold,
              ),
            ),
          if (isHaidFase) const SizedBox(height: 4),
          Text(
            label,
            style: const TextStyle(
              color: Colors.white70,
              fontSize: 14,
              fontWeight: FontWeight.w500,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            tanggal,
            style: const TextStyle(
              color: Colors.white,
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }
}
