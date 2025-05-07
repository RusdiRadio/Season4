import 'package:flutter/material.dart';
import 'bottom_navbar.dart';

class ProfilePage extends StatelessWidget {
  const ProfilePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Profil")),
      body: const Center(child: Text("Ini adalah halaman Profil")),
    );
  }
}
