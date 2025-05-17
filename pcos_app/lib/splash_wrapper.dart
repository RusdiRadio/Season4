import 'package:flutter/material.dart';
import 'login_screen.dart';

class SplashWrapper extends StatelessWidget {
  const SplashWrapper({super.key});

  @override
  Widget build(BuildContext context) {
    // Di sini kamu bisa ganti logika login cek dari SharedPreferences nanti
    return const WelcomeScreen();
  }
}
