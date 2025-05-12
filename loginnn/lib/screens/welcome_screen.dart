import 'package:flutter/material.dart';
import 'package:loginnn/screens/signin_screen.dart';
import 'package:loginnn/screens/signup_screen.dart';
import 'package:loginnn/theme/theme.dart';
import 'package:loginnn/widgets/custom_scaffold.dart';

class WelcomeScreen extends StatelessWidget {
  const WelcomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return CustomScaffold(
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 40.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
             Text(
              'Welcome OvaSafe Apps ',
              style: TextStyle(
                fontSize: 45.0,
                fontWeight: FontWeight.w600,
                color: Color.fromARGB(255, 255, 255, 255)
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 7),
            Text(
              'Enter personal details to your employee account',
              style: TextStyle(
                fontSize: 20,
                color:Color.fromARGB(255, 255, 255, 255)
                
              ),
              textAlign: TextAlign.center,
            ),
             SizedBox(height: 40),
            // Baris tombol Sign in dan Sign up
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                // Tombol Sign In
                ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => const SignInScreen()),
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color.fromARGB(255, 255, 255, 255),
                    foregroundColor: Color.fromARGB(255, 255, 138, 201),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(20), // Sudut tumpul
                    ),
                    padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                  ),
                  child: const Text(
                    'Sign in',
                    style: TextStyle(fontSize: 17),
                  ),
                ),
                 SizedBox(width: 20),
                // Tombol Sign Up
                ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => const SignUpScreen()),
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Color.fromARGB(255, 255, 156, 217),
                    foregroundColor: const Color.fromARGB(255, 255, 255, 255),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(20), // Sudut tumpul
                    ),
                    padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                  ),
                  child: const Text(
                    'Sign up',
                    style: TextStyle(fontSize: 17),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

