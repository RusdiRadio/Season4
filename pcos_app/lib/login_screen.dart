import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '/screens/signin_screen.dart';
import '/screens/signup_screen.dart';
import '/theme/theme.dart'; // tetap dipertahankan
import '/widgets/custom_scaffold.dart';

class WelcomeScreen extends StatelessWidget {
  const WelcomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [
              Color(0xFFF8BBD0), // Soft pink
              Color(0xFFE91E63), // Pink tua
            ],
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
          ),
        ),
        width: double.infinity,
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 32.0),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                // Logo
                Image.asset(
                  'assets/images/logo.png',
                  width: 100,
                  height: 100,
                  fit: BoxFit.contain,
                ),
                const SizedBox(height: 24),

                // Teks utama
                Text(
                  'Welcome to Ovasafe',
                  style: GoogleFonts.poppins(
                    fontSize: 40.0,
                    fontWeight: FontWeight.w700,
                    color: Colors.white,
                    letterSpacing: 1.2,
                  ),
                  textAlign: TextAlign.center,
                ),

                const SizedBox(height: 12),

                Text(
                  'Kenali Gejala PCOS Lebih Awal, Jaga Kesehatan Reproduksi Anda',
                  style: GoogleFonts.poppins(
                    fontSize: 18,
                    color: Colors.white70,
                  ),
                  textAlign: TextAlign.center,
                ),

                const SizedBox(height: 48),

                // Tombol Sign in dan Sign up
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    // Tombol Login
                    ElevatedButton(
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => const SignInScreen(),
                          ),
                        );
                      },
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.white,
                        foregroundColor: const Color(0xFFE91E63),
                        elevation: 4,
                        shadowColor: Colors.black38,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        padding: const EdgeInsets.symmetric(
                            horizontal: 28, vertical: 14),
                      ),
                      child: Text(
                        'Login',
                        style: GoogleFonts.poppins(
                            fontSize: 16, fontWeight: FontWeight.w500),
                      ),
                    ),

                    const SizedBox(width: 20),

                    // Tombol Daftar
                    ElevatedButton(
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => const SignUpScreen(),
                          ),
                        );
                      },
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xFFE91E63),
                        foregroundColor: Colors.white,
                        elevation: 4,
                        shadowColor: Colors.black38,
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                        padding: const EdgeInsets.symmetric(
                            horizontal: 28, vertical: 14),
                      ),
                      child: Text(
                        'Daftar',
                        style: GoogleFonts.poppins(
                            fontSize: 16, fontWeight: FontWeight.w500),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
