import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import '/screens/signin_screen.dart';
import '/theme/theme.dart';
import '/widgets/custom_scaffold.dart';

class SignUpScreen extends StatefulWidget {
  const SignUpScreen({super.key});

  @override
  State<SignUpScreen> createState() => _SignUpScreenState();
}

class _SignUpScreenState extends State<SignUpScreen> {
  final _formSignupKey = GlobalKey<FormState>();
  final TextEditingController _namaController = TextEditingController();
  final TextEditingController _usernameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  bool agreePersonalData = true;
  bool _obscurePassword = true;

  Future<void> registerUser() async {
    final url = Uri.parse(
        'http://localhost:8000/api/register'); // Ganti jika bukan emulator

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'nama': _namaController.text,
          'username': _usernameController.text,
          'email': _emailController.text,
          'password': _passwordController.text,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 201) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(data['message'] ?? 'Registration successful')),
        );
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => const SignInScreen()),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(data['error'] ?? 'Registration failed')),
        );
      }
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return CustomScaffold(
      child: SafeArea(
        child: SingleChildScrollView(
          child: Padding(
            padding: const EdgeInsets.only(bottom: 40.0),
            child: Column(
              children: [
                const SizedBox(height: 10),
                Container(
                  padding: const EdgeInsets.fromLTRB(40.0, 50.0, 40.0, 20.0),
                  decoration: const BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(40.0),
                      topRight: Radius.circular(40.0),
                    ),
                  ),
                  child: Form(
                    key: _formSignupKey,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Text(
                          'Create Account',
                          style: TextStyle(
                            fontSize: 30.0,
                            fontWeight: FontWeight.bold,
                            color: Colors.black,
                          ),
                        ),
                        const SizedBox(height: 40.0),
                        _buildInputField(
                          controller: _namaController,
                          label: 'Full Name',
                          hint: 'Enter your full name',
                          validatorText: 'Please enter full name',
                        ),
                        const SizedBox(height: 20.0),
                        _buildInputField(
                          controller: _usernameController,
                          label: 'Username',
                          hint: 'Enter your username',
                          validatorText: 'Please enter username',
                        ),
                        const SizedBox(height: 20.0),
                        _buildInputField(
                          controller: _emailController,
                          label: 'Email',
                          hint: 'Enter your email',
                          validatorText: 'Please enter email',
                        ),
                        const SizedBox(height: 20.0),
                        TextFormField(
                          controller: _passwordController,
                          obscureText: _obscurePassword,
                          obscuringCharacter: '*',
                          validator: (value) {
                            if (value == null || value.length < 8) {
                              return 'Password must be at least 8 characters';
                            }
                            return null;
                          },
                          decoration:
                              _inputDecoration('Password', 'Create a password')
                                  .copyWith(
                            suffixIcon: IconButton(
                              icon: Icon(
                                _obscurePassword
                                    ? Icons.visibility_off
                                    : Icons.visibility,
                                color: Colors.grey,
                              ),
                              onPressed: () {
                                setState(() {
                                  _obscurePassword = !_obscurePassword;
                                });
                              },
                            ),
                          ),
                        ),
                        const SizedBox(height: 25.0),
                        Row(
                          children: [
                            Checkbox(
                              value: agreePersonalData,
                              onChanged: (value) =>
                                  setState(() => agreePersonalData = value!),
                              activeColor: lightColorScheme.primary,
                            ),
                            const Flexible(
                                child: Text('I agree to the processing of ')),
                            Text(
                              'personal data',
                              style: TextStyle(
                                fontWeight: FontWeight.bold,
                                color: lightColorScheme.primary,
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 25.0),
                        SizedBox(
                          width: double.infinity,
                          child: ElevatedButton(
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color(0xFFE91E63),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(12),
                              ),
                              padding: const EdgeInsets.symmetric(vertical: 16),
                              elevation: 4,
                            ),
                            onPressed: () {
                              if (_formSignupKey.currentState!.validate()) {
                                if (agreePersonalData) {
                                  registerUser();
                                } else {
                                  ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                      content: Text(
                                          'Please agree to the processing of personal data'),
                                    ),
                                  );
                                }
                              }
                            },
                            child: const Text(
                              'Sign Up',
                              style: TextStyle(
                                fontWeight: FontWeight.bold,
                                fontSize: 16,
                                color: Colors.white,
                              ),
                            ),
                          ),
                        ),
                        const SizedBox(height: 20),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            const Text(
                              'Already have an account? ',
                              style: TextStyle(color: Colors.black54),
                            ),
                            GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (_) => const SignInScreen(),
                                  ),
                                );
                              },
                              child: Text(
                                'Sign In',
                                style: TextStyle(
                                  fontWeight: FontWeight.bold,
                                  color: lightColorScheme.primary,
                                ),
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 10),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildInputField({
    required TextEditingController controller,
    required String label,
    required String hint,
    required String validatorText,
  }) {
    return TextFormField(
      controller: controller,
      validator: (value) {
        if (value == null || value.isEmpty) {
          return validatorText;
        }
        return null;
      },
      decoration: _inputDecoration(label, hint),
    );
  }

  InputDecoration _inputDecoration(String label, String hint) {
    return InputDecoration(
      labelText: label,
      hintText: hint,
      filled: true,
      fillColor: Colors.grey[100],
      labelStyle: const TextStyle(color: Colors.black87),
      hintStyle: const TextStyle(color: Colors.black38),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: Colors.grey.shade300),
      ),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: Colors.grey.shade300),
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(12),
        borderSide: BorderSide(color: lightColorScheme.primary, width: 2),
      ),
    );
  }
}
