import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

import 'bottom_navbar.dart'; // Mengimpor BottomNavBar
import 'profil_home.dart';
import 'riwayat.dart';
import 'tentang.dart';

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
      home: const MyHomePage(),
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

  final List<Widget> _pages = <Widget>[
    const SettingsPage(),
    const NotificationPage(),
    const BMICalculatorPage(),
    const ProfilePage(),
  ];

  void _onNavTapped(int index) {
    setState(() {
      _selectedIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: DecoratedBox(
        decoration: BoxDecoration(
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
                    mainAxisAlignment:
                        MainAxisAlignment.center, // Untuk memusatkan
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
                // 🔽 Lanjutkan konten lainnya seperti biasa
                ProfileAvatar(),
                SizedBox(height: 24),
                RiwayatBar(),
                SizedBox(height: 16),
                TentangPCOSBar(),
                SizedBox(height: 100),
                SizedBox(height: 16),
              ],
            ),
          ),
        ),
      ),

      // 🏷️ Bottom Nav + Tombol Cek Sekarang!
      bottomNavigationBar: BottomNavBar(
        currentIndex: _selectedIndex,
        onTap: _onNavTapped,
      ),
      floatingActionButton: Padding(
        padding: const EdgeInsets.only(bottom: 70),
        child: SizedBox(
          width: MediaQuery.of(context).size.width * 0.85,
          child: FloatingActionButton.extended(
            onPressed: () {
              print("Tombol Ayo cek sekarang! ditekan");
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
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
    );
  }
}

// 📄 Halaman Pengaturan
class SettingsPage extends StatelessWidget {
  const SettingsPage({super.key});
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Text('Halaman Pengaturan', style: TextStyle(fontSize: 18)),
    );
  }
}

// 📄 Halaman Notifikasi
class NotificationPage extends StatelessWidget {
  const NotificationPage({super.key});
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Text('Halaman Notifikasi', style: TextStyle(fontSize: 18)),
    );
  }
}

// 📄 Halaman BMI
class BMICalculatorPage extends StatelessWidget {
  const BMICalculatorPage({super.key});
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Text('Kalkulator BMI', style: TextStyle(fontSize: 18)),
    );
  }
}

// 📄 Halaman Profil
class ProfilePage extends StatelessWidget {
  const ProfilePage({super.key});
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Text('Halaman Profil', style: TextStyle(fontSize: 18)),
    );
  }
}
