import 'package:flutter/material.dart';

class CustomBottomNav extends StatelessWidget {
  final VoidCallback onMenuPressed;
  final VoidCallback onHomePressed;
  final VoidCallback onEmergencyPressed;

  const CustomBottomNav({
    super.key,
    required this.onMenuPressed,
    required this.onHomePressed,
    required this.onEmergencyPressed,
  });

  @override
  Widget build(BuildContext context) {
    return BottomAppBar(
      shape: const CircularNotchedRectangle(),
      notchMargin: 8,
      child: SizedBox(
        height: 60,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            IconButton(
              icon: const Icon(Icons.menu),
              onPressed: onMenuPressed,
            ),
            const SizedBox(width: 40), // space for the big middle button
            IconButton(
              icon: const Icon(Icons.home),
              onPressed: onHomePressed,
            ),
          ],
        ),
      ),
    );
  }
}

class EmergencyButton extends StatelessWidget {
  final VoidCallback onPressed;

  const EmergencyButton({super.key, required this.onPressed});

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: 100, // Ganti angka ini sesuai keinginanmu (default: ~56)
      height: 100,
      child: FloatingActionButton(
        onPressed: onPressed,
        backgroundColor: Colors.red,
        shape: const CircleBorder(),
        child: const Text(
          'DARURAT!',
          textAlign: TextAlign.center,
          style: TextStyle(
              fontSize: 16, fontWeight: FontWeight.bold, color: Colors.white),
        ),
      ),
    );
  }
}
