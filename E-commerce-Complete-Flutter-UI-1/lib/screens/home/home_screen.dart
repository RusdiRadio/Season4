import 'package:flutter/material.dart';
import 'components/categories.dart';
import 'components/discount_banner.dart';
import 'components/home_header.dart';
import 'components/custom_button.dart'; // <--- tambahkan ini
import 'components/about_section.dart';

class HomeScreen extends StatelessWidget {
  static String routeName = "/home";

  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: const SafeArea(
        child: SingleChildScrollView(
          padding: EdgeInsets.symmetric(vertical: 16),
          child: Column(
            children: [
              HomeHeader(),
              DateTimeBanner(),
              Categories(),
              AboutSection()
            ],
          ),
        ),
      ),
      bottomNavigationBar: CustomBottomNav(
        onMenuPressed: () {
          // aksi ketika tombol menu ditekan
        },
        onHomePressed: () {
          // aksi ketika tombol home ditekan
        },
        onEmergencyPressed: () {
          // akan dipicu lewat FAB di bawah
        },
      ),
      floatingActionButton: EmergencyButton(
        onPressed: () {
          // aksi ketika tombol DARURAT! ditekan
          showDialog(
            context: context,
            builder: (_) => AlertDialog(
              title: const Text("DARURAT!"),
              content: const Text("Tombol darurat ditekan."),
              actions: [
                TextButton(
                  onPressed: () => Navigator.pop(context),
                  child: const Text("OK"),
                ),
              ],
            ),
          );
        },
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
    );
  }
}
