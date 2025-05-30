import 'package:flutter/material.dart';

class TentangPCOSBar extends StatelessWidget {
  const TentangPCOSBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      margin: const EdgeInsets.symmetric(horizontal: 40, vertical: 12),
      decoration: BoxDecoration(
        color: Colors.grey.withOpacity(0.1), // Warna tetap
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 6,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Header dengan ikon
          Row(
            children: const [
              Icon(Icons.info_outline, color: Color.fromARGB(255, 233, 30, 99)),
              SizedBox(width: 8),
              Text(
                'Tentang PCOS',
                style: TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: Color.fromARGB(255, 233, 30, 99),
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          // Konten dengan teks informatif
          const Text(
            'Polycystic Ovary Syndrome (PCOS) adalah gangguan hormonal umum pada wanita yang dapat memengaruhi kesuburan. '
            'Gejala umum meliputi siklus menstruasi tidak teratur, kadar hormon androgen tinggi, dan ovarium membesar '
            'dengan kantong cairan kecil. Penyebabnya belum sepenuhnya dipahami, tetapi faktor genetik dan hormonal berperan besar.',
            style: TextStyle(
              fontSize: 14.5,
              height: 1.5,
              color: Colors.black87,
            ),
            textAlign: TextAlign.justify,
          ),
        ],
      ),
    );
  }
}
