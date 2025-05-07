import 'package:flutter/material.dart';

import 'bottom_navbar.dart';

class BMICalculatorPage extends StatelessWidget {
  const BMICalculatorPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Kalkulator BMI")),
      body: const Center(child: Text("Ini adalah halaman Kalkulator BMI")),
      
    );
  }
}
