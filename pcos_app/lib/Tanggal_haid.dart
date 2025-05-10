import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class TanggalHaid extends StatelessWidget {
  const TanggalHaid({super.key});

  @override
  Widget build(BuildContext context) {
    final now = DateTime.now();
    final yesterday = now.subtract(const Duration(days: 1));
    final tomorrow = now.add(const Duration(days: 1));

    final dateFormat = DateFormat('EEEE, d MMMM y', 'id_ID');

    return Align(
      alignment: Alignment.topCenter,
      child: Padding(
        padding: const EdgeInsets.only(top: 10),
        child: SingleChildScrollView(
          scrollDirection: Axis.horizontal,
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Row(
            children: [
              _buildTanggalTile("Kemarin", dateFormat.format(yesterday)),
              const SizedBox(width: 12),
              _buildTanggalTile("Hari Ini", dateFormat.format(now)),
              const SizedBox(width: 12),
              _buildTanggalTile("Besok", dateFormat.format(tomorrow)),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTanggalTile(String label, String tanggal) {
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
