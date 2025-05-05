import 'package:flutter/material.dart';

class ProfileAvatar extends StatelessWidget {
  final double size;

  const ProfileAvatar({super.key, this.size = 120}); // default lebih besar

  @override
  Widget build(BuildContext context) {
    return Align(
      alignment: Alignment.topCenter,
      child: Padding(
        padding: const EdgeInsets.only(top: 10),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            CircleAvatar(
              radius: size / 2,
              backgroundColor: Colors.white,
              child: Icon(
                Icons.person,
                size: size / 2,
                color: Colors.grey,
              ),
            ),
            const SizedBox(height: 12), // jarak antara lingkaran dan teks
            const Text(
              'Profil',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w600,
                color: Colors.white, // atau sesuaikan dengan background
              ),
            ),
          ],
        ),
      ),
    );
  }
}
