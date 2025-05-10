import 'package:flutter/material.dart';
import 'bottom_navbar.dart';

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
      appBar: AppBar(
        title: const Text("Kalkulator BMI"),
        backgroundColor: const Color(0xFFF06A8D),
      ),
      body: Padding(
        padding: const EdgeInsets.all(24.0),
        child: Column(
          children: [
            TextField(
              controller: _heightController,
              keyboardType: TextInputType.number,
              decoration: const InputDecoration(
                labelText: 'Tinggi badan (cm)',
                border: OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 16),
            TextField(
              controller: _weightController,
              keyboardType: TextInputType.number,
              decoration: const InputDecoration(
                labelText: 'Berat badan (kg)',
                border: OutlineInputBorder(),
              ),
            ),
            const SizedBox(height: 24),
            ElevatedButton(
              onPressed: _calculateBMI,
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFFF06A8D),
              ),
              child: const Text('Hitung BMI'),
            ),
            const SizedBox(height: 24),
            if (_bmiResult != null)
              Column(
                children: [
                  Text(
                    "BMI kamu: ${_bmiResult!.toStringAsFixed(2)}",
                    style: const TextStyle(
                        fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    "Status: $_status",
                    style: const TextStyle(fontSize: 18),
                  ),
                ],
              )
            else if (_status.isNotEmpty)
              Text(
                _status,
                style: const TextStyle(color: Colors.red),
              )
          ],
        ),
      ),
    );
  }
}
