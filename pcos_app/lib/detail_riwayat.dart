import 'package:flutter/material.dart';

class DetailRiwayat extends StatelessWidget {
  const DetailRiwayat({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Detail Riwayat'),
        backgroundColor: const Color(0xFFF06A8D),
      ),
      body: const Center(
        child: Text(
          'Halaman detail riwayat masih kosong~',
          style: TextStyle(fontSize: 18),
        ),
      ),
    );
  }
}
