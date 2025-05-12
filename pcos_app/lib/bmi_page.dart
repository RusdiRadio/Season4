import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class BMICalculatorPage extends StatefulWidget {
  const BMICalculatorPage({super.key});

  @override
  State<BMICalculatorPage> createState() => _BMICalculatorPageState();
}

class _BMICalculatorPageState extends State<BMICalculatorPage> {
  final TextEditingController _heightController = TextEditingController();
  final TextEditingController _weightController = TextEditingController();
  double? _bmiResult;
  String _status = "";

  void _calculateBMI() {
    final double? height = double.tryParse(_heightController.text);
    final double? weight = double.tryParse(_weightController.text);

    if (height != null && weight != null && height > 0) {
      final double bmi = weight / ((height / 100) * (height / 100));
      setState(() {
        _bmiResult = bmi;

        if (bmi < 18.5) {
          _status = "Kurus";
        } else if (bmi >= 18.5 && bmi < 24.9) {
          _status = "Normal";
        } else if (bmi >= 25 && bmi < 29.9) {
          _status = "Gemuk";
        } else {
          _status = "Obesitas";
        }
      });
    } else {
      setState(() {
        _bmiResult = null;
        _status = "Input tidak valid";
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: const BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            Color(0xFFFFE4E1),
            Color.fromARGB(255, 255, 83, 112),
          ],
        ),
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        appBar: AppBar(
          title: const Text("Kalkulator BMI"),
          backgroundColor: Colors.transparent,
          elevation: 0,
          foregroundColor: Colors.white,
        ),
        body: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24.0),
            child: Column(
              children: [
                // Input Field for Height
                _buildTextField(
                    _heightController, 'Tinggi badan (cm)', Icons.height),

                const SizedBox(height: 16),

                // Input Field for Weight
                _buildTextField(_weightController, 'Berat badan (kg)',
                    Icons.fitness_center),

                const SizedBox(height: 24),

                // BMI Calculate Button
                ElevatedButton(
                  onPressed: _calculateBMI,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFFF06A8D),
                    foregroundColor: Colors.white,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(
                          30), // Rounded corners for button
                    ),
                    padding: const EdgeInsets.symmetric(
                        vertical: 16, horizontal: 24),
                  ),
                  child: Text(
                    'Hitung BMI',
                    style: GoogleFonts.poppins(
                        fontSize: 18, fontWeight: FontWeight.w600),
                  ),
                ),

                const SizedBox(height: 24),

                // Display Result
                if (_bmiResult != null)
                  Column(
                    children: [
                      Text(
                        "BMI kamu: ${_bmiResult!.toStringAsFixed(2)}",
                        style: GoogleFonts.poppins(
                          fontSize: 24,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 8),
                      Text(
                        "Status: $_status",
                        style: GoogleFonts.poppins(
                          fontSize: 20,
                          color: Colors.white,
                        ),
                      ),
                    ],
                  )
                else if (_status.isNotEmpty)
                  Text(
                    _status,
                    style: const TextStyle(color: Colors.white),
                  ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  // Reusable text field widget with icon
  Widget _buildTextField(
      TextEditingController controller, String label, IconData icon) {
    return TextField(
      controller: controller,
      keyboardType: TextInputType.number,
      decoration: InputDecoration(
        labelText: label,
        border: OutlineInputBorder(),
        filled: true,
        fillColor: Colors.white,
        prefixIcon: Icon(icon, color: Colors.pinkAccent),
        labelStyle: GoogleFonts.poppins(fontSize: 16, color: Colors.pinkAccent),
      ),
    );
  }
}
