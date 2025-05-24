import 'package:flutter/material.dart';

class TentangPCOSBar extends StatelessWidget {
  const TentangPCOSBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
      margin: const EdgeInsets.symmetric(horizontal: 40),
      height: 180, // Sesuaikan tinggi bar
      decoration: BoxDecoration(
         color: Colors.grey.withOpacity(0.1), // Warna abu-abu transparan
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Teks "Tentang PCOS"
          const Text(
            'Tentang PCOS',
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: Color.fromARGB(255, 233, 30, 99), // Warna teks
            ),
          ),
          const SizedBox(height: 10), // Jarak antar teks judul dan konten
          // Isi konten bar (dapat diganti dengan informasi terkait PCOS)
          Flexible(
            child: SingleChildScrollView(
              child: Text(
                'Polycystic Ovary Syndrome (PCOS) adalah gangguan hormonal umum pada wanita yang dapat memengaruhi kesuburan. Gejala umum PCOS meliputi siklus menstruasi yang tidak teratur, kadar hormon androgen yang lebih tinggi, serta ovarium yang membesar dengan kantong cairan kecil. Penyebab pasti PCOS masih belum sepenuhnya dipahami, tetapi faktor genetik dan ketidakseimbangan hormon diduga berperan besar.',
                style: TextStyle(
                  fontSize: 14,
                  color: Colors.black87,
                ),
              ),
            ),
          ),
          const SizedBox(height: 10), // Jarak untuk memberi ruang
        ],
      ),
    );
  }
}
