import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:syncfusion_flutter_gauges/gauges.dart';

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
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        backgroundColor: const Color.fromARGB(255, 255, 118, 205),
        elevation: 0,
        centerTitle: true,
        title: Text(
          "Kalkulator BMI",
          style: GoogleFonts.poppins(
            color: Colors.white,
            fontWeight: FontWeight.w600,
            fontSize: 20,
          ),
        ),
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(24.0),
          child: Column(
            children: [
              _buildTextField(
                  _heightController, 'Tinggi badan (cm)', Icons.height),
              const SizedBox(height: 16),
              _buildTextField(
                  _weightController, 'Berat badan (kg)', Icons.fitness_center),
              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: _calculateBMI,
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color.fromARGB(255, 233, 30, 99),
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10),
                  ),
                  padding:
                      const EdgeInsets.symmetric(vertical: 16, horizontal: 24),
                ),
                child: Text(
                  'Hitung BMI',
                  style: GoogleFonts.poppins(
                    fontSize: 16,
                    fontWeight: FontWeight.w500,
                    letterSpacing: 0.5,
                  ),
                ),
              ),
              const SizedBox(height: 24),
              if (_bmiResult != null)
                Column(
                  children: [
                    Text(
                      "BMI kamu: ${_bmiResult!.toStringAsFixed(2)}",
                      style: GoogleFonts.poppins(
                        fontSize: 24,
                        color: Colors.black,
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      "Status: $_status",
                      style: GoogleFonts.poppins(
                        fontSize: 16,
                        color: Colors.black,
                      ),
                    ),
                    const SizedBox(height: 24),
                    SfRadialGauge(
                      axes: <RadialAxis>[
                        RadialAxis(
                          minimum: 10,
                          maximum: 40,
                          ranges: <GaugeRange>[
                            GaugeRange(
                                startValue: 10,
                                endValue: 18.5,
                                color: Colors.blue), // Kurus
                            GaugeRange(
                                startValue: 18.5,
                                endValue: 24.9,
                                color: Colors.green), // Normal
                            GaugeRange(
                                startValue: 25,
                                endValue: 29.9,
                                color: Colors.orange), // Gemuk
                            GaugeRange(
                                startValue: 30,
                                endValue: 40,
                                color: Colors.red), // Obesitas
                          ],
                          pointers: <GaugePointer>[
                            NeedlePointer(
                              value: _bmiResult!,
                              needleColor: Colors.black,
                              knobStyle: KnobStyle(color: Colors.black),
                            )
                          ],
                          annotations: <GaugeAnnotation>[
                            GaugeAnnotation(
                              widget: Text(
                                '${_bmiResult!.toStringAsFixed(1)}',
                                style: GoogleFonts.poppins(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              angle: 90,
                              positionFactor: 0.75,
                            )
                          ],
                        )
                      ],
                    ),
                  ],
                )
              else if (_status.isNotEmpty)
                Text(
                  _status,
                  style: GoogleFonts.poppins(
                    fontSize: 16,
                    color: Colors.black,
                  ),
                ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildTextField(
      TextEditingController controller, String label, IconData icon) {
    return TextField(
      controller: controller,
      keyboardType: TextInputType.number,
      decoration: InputDecoration(
        labelText: label,
        filled: true,
        fillColor: Colors.grey.withOpacity(0.1),
        prefixIcon: Icon(icon, color: const Color.fromARGB(255, 233, 30, 99)),
        labelStyle: GoogleFonts.poppins(
            fontSize: 16, color: const Color.fromARGB(255, 0, 0, 0)),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: BorderSide.none,
        ),
      ),
    );
  }
}
