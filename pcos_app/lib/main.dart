import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:pcos_app/splash_wrapper.dart';

import 'bottom_navbar.dart';
import 'profil_home.dart';
import 'riwayat.dart';
import 'tentang.dart';
import 'prediksi_page.dart';

// Halaman tambahan
import 'notif_page.dart';
import 'bmi_page.dart';
import 'profile_page.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'PCOS App',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.pink),
        useMaterial3: true,
      ),
      home: const SplashWrapper(),
      debugShowCheckedModeBanner: false,
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  int _selectedIndex = 0;

  final List<Widget> _pages = [
    HomePage(), // Halaman awal kamu
    NotifPage(),
    BMICalculatorPage(),
    ProfilePage(),
    PrediksiPage(),
  ];

  void _onNavTapped(int index) {
    setState(() {
      _selectedIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _pages[_selectedIndex],
      bottomNavigationBar: BottomNavBar(
        currentIndex: _selectedIndex,
        onTap: _onNavTapped,
      ),
      floatingActionButton: _selectedIndex == 0
          ? Padding(
              padding: const EdgeInsets.only(bottom: 70),
              child: SizedBox(
                width: MediaQuery.of(context).size.width * 0.85,
                child: FloatingActionButton.extended(
                  onPressed: () {
                    Navigator.push(
                      context,
                      PageRouteBuilder(
                        pageBuilder: (_, __, ___) => const PrediksiPage(),
                        transitionDuration: Duration.zero,
                        reverseTransitionDuration: Duration.zero,
                      ),
                    );
                  },
                  label: const Text(
                    "Ayo cek sekarang!",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                  backgroundColor: const Color(0xFFF06A8D),
                  elevation: 4,
                ),
              ),
            )
          : null,
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
    );
  }
}

class HomePage extends StatelessWidget {
  const HomePage({super.key});

  @override
  Widget build(BuildContext context) {
    return DecoratedBox(
      decoration: const BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Color(0xFFFFE4E1), // Pink muda
            Color.fromARGB(255, 255, 83, 112), // Pink tua
          ],
        ),
      ),
      child: SingleChildScrollView(
        child: SizedBox(
          width: double.infinity,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // 🔽 Judul & Logout di baris yang sama
              Padding(
                padding:
                    const EdgeInsets.symmetric(horizontal: 16, vertical: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Expanded(
                      child: Align(
                        alignment: Alignment.center,
                        child: Text(
                          'OvaSafe',
                          style: GoogleFonts.arimo(
                            fontSize: 24,
                            fontStyle: FontStyle.italic,
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
                          ),
                        ),
                      ),
                    ),
                    IconButton(
                      icon: const Icon(Icons.logout, color: Colors.white),
                      onPressed: () {
                        print("Logout ditekan");
                      },
                    ),
                  ],
                ),
              ),
              const ProfileAvatar(),
              const SizedBox(height: 24),
              const RiwayatBar(),
              const SizedBox(height: 16),
              const TentangPCOSBar(),
              const SizedBox(height: 100),
            ],
          ),
        ),
      ),
    );
  }
}
