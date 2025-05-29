import 'package:flutter/material.dart';
import 'detail_riwayat.dart'; // Import halaman tujuan

class RiwayatBar extends StatelessWidget {
  const RiwayatBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      margin: const EdgeInsets.symmetric(horizontal: 40, vertical: 12),
      height: 130,
      decoration: BoxDecoration(
        color: Colors.grey.withOpacity(0.1), // Warna tetap sesuai permintaan
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
        children: [
          Row(
            children: const [
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
          const SizedBox(height: 6),
          const Text(
            'Lihat ringkasan atau detail riwayat pemeriksaan Anda.',
            style: TextStyle(
              fontSize: 13,
              color: Colors.black87,
            ),
          ),
          const Spacer(),
          Align(
            alignment: Alignment.bottomRight,
            child: ElevatedButton.icon(
              onPressed: () {
                // Navigasi ke halaman detail
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => const DetailRiwayat(),
                  ),
                );
              },
              icon: const Icon(Icons.history, size: 18, color: Colors.white),
              label: const Text(
                'Riwayat',
                style: TextStyle(
                  fontSize: 14,
                  fontWeight: FontWeight.bold,
                  color: Colors.white,
                ),
              ),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color.fromARGB(255, 233, 30, 99),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
                padding:
                    const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
                elevation: 2,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
