import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class HomeHeader extends StatelessWidget {
  const HomeHeader({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
      child: Row(
        children: [
          Text(
            "SiJago", // <-- Ganti nama sesuai keinginanmu
            style: GoogleFonts.robotoCondensed(
              textStyle: const TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
                color: Colors.redAccent,
              ),
            ),
          ),
          const Spacer(),
          IconButton(
            onPressed: () {
              // Tambahkan aksi logout di sini
              showDialog(
                context: context,
                builder: (_) => AlertDialog(
                  title: const Text("Logout"),
                  content: const Text("Yakin ingin keluar?"),
                  actions: [
                    TextButton(
                      onPressed: () => Navigator.pop(context),
                      child: const Text("Batal"),
                    ),
                    TextButton(
                      onPressed: () {
                        Navigator.pop(context);
                        // Lakukan aksi logout
                      },
                      child: const Text("Keluar"),
                    ),
                  ],
                ),
              );
            },
            icon: const Icon(Icons.logout, color: Colors.grey),
          ),
        ],
      ),
    );
  }
}
