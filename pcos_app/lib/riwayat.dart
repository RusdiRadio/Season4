import 'package:flutter/material.dart';

class RiwayatBar extends StatelessWidget {
  const RiwayatBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
      margin: const EdgeInsets.symmetric(horizontal: 40),
      // Menggunakan Flexible atau Expanded untuk memberikan ruang lebih dinamis
      height: 120, // Atur tinggi lebih besar jika perlu
      decoration: BoxDecoration(
        color: const Color(0xFFF6D5DC), // Warna bar
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        mainAxisAlignment:
            MainAxisAlignment.spaceBetween, // Menjaga jarak vertikal
        crossAxisAlignment:
            CrossAxisAlignment.start, // Menjaga teks di kiri atas
        children: [
          // Teks di kiri atas
          Text(
            'Hasil Terakhir',
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: const Color(0xFFF06A8D), // Warna teks
            ),
          ),
          // Gunakan Expanded untuk tombol agar berada di bagian bawah dan tidak menyebabkan overflow
          Expanded(
            child: Align(
              alignment: Alignment.bottomRight,
              child: ElevatedButton(
                onPressed: () {
                  // Aksi nanti bisa ditambah di sini
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFFF06A8D), // Warna tombol
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  padding:
                      const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                ),
                child: const Text(
                  'Riwayat',
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
