import 'package:flutter/material.dart';
import 'main.dart'; // atau file yang berisi MyHomePage kamu

class LoginScreen extends StatelessWidget {
  const LoginScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.pink[50],
      body: Center(
        child: ElevatedButton(
          style: ElevatedButton.styleFrom(
            backgroundColor: const Color(0xFFF06A8D),
          ),
          onPressed: () {
            // Setelah login, arahkan ke halaman utama
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (context) => const MyHomePage()),
            );
          },
          child: const Text('Login ke OvaSafe'),
        ),
      ),
    );
  }
}
