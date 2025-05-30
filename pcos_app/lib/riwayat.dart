import 'package:flutter/material.dart';

class RiwayatBar extends StatelessWidget {
  const RiwayatBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      margin: const EdgeInsets.symmetric(horizontal: 40, vertical: 12),
      height: 130,
      decoration: BoxDecoration(
        color: Colors.grey.withOpacity(0.1),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 8,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: const [
          Row(
            children: [
              Icon(
                Icons.assignment_turned_in_outlined,
                color: Color.fromARGB(255, 233, 30, 99),
                size: 20,
              ),
              SizedBox(width: 8),
              Text(
                'Hasil Terakhir',
                style: TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: Color.fromARGB(255, 233, 30, 99),
                ),
              ),
            ],
          ),
          SizedBox(height: 6),
          Text(
            'Lihat ringkasan atau detail riwayat pemeriksaan Anda.',
            style: TextStyle(
              fontSize: 13,
              color: Colors.black87,
            ),
          ),
        ],
      ),
    );
  }
}
