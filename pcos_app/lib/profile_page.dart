import 'dart:io';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:image_picker/image_picker.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  File? _profileImage;
  final picker = ImagePicker();

  final TextEditingController _namaPenggunaController = TextEditingController();
  final TextEditingController _namaController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

  final Color pinkColor = const Color.fromARGB(255, 233, 30, 99);

  bool _isLoading = true;
  Map<String, dynamic>? _rawUserData;

  @override
  void initState() {
    super.initState();
    _loadProfileData();
  }

  Future<void> _pickImage() async {
    final pickedFile = await picker.pickImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      setState(() {
        _profileImage = File(pickedFile.path);
      });
    }
  }

  Future<void> _loadProfileData() async {
    final prefs = await SharedPreferences.getInstance();
    final userId = prefs.getInt('userId') ?? 0;
    final url = Uri.parse('http://localhost/api/get-user/$userId');

    try {
      final response = await http.get(url);
      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        setState(() {
          _namaPenggunaController.text = data['username'] ?? '';
          _namaController.text = data['nama'] ?? '';
          _emailController.text = data['email'] ?? '';
          _passwordController.text = '';
          _rawUserData = data;
          _isLoading = false;
        });
      } else {
        debugPrint('Gagal load profile, status: ${response.statusCode}');
        setState(() => _isLoading = false);
      }
    } catch (e) {
      debugPrint('Error saat load profile: $e');
      setState(() => _isLoading = false);
    }
  }

  Future<Map<String, dynamic>> updateProfileOnServer() async {
    final prefs = await SharedPreferences.getInstance();
    final userId = prefs.getInt('userId') ?? 0;
    final url = Uri.parse('http://localhost/update-profile/$userId');

    Map<String, dynamic> body = {
      'username': _namaPenggunaController.text,
      'nama': _namaController.text,
      'email': _emailController.text,
    };
    if (_passwordController.text.isNotEmpty) {
      body['password'] = _passwordController.text;
    }

    try {
      final response = await http.put(
        url,
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(body),
      );

      if (response.statusCode == 200) {
        final updatedData = jsonDecode(response.body);
        // Update tampilan juga setelah update berhasil
        setState(() {
          _rawUserData = updatedData;
        });
        return {'status': 'success'};
      } else {
        return {
          'status': 'error',
          'message': 'Gagal update profile, status: ${response.statusCode}',
        };
      }
    } catch (e) {
      return {'status': 'error', 'message': 'Error update profile: $e'};
    }
  }

  Widget _buildProfileItem(
      String hint, TextEditingController controller, IconData icon,
      {bool obscureText = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
        decoration: BoxDecoration(
          color: Colors.grey.withOpacity(0.1),
          borderRadius: BorderRadius.circular(12),
        ),
        child: Row(
          children: [
            Icon(icon, color: pinkColor),
            const SizedBox(width: 12),
            Expanded(
              child: TextField(
                controller: controller,
                obscureText: obscureText,
                style: const TextStyle(color: Colors.black),
                decoration: InputDecoration(
                  border: InputBorder.none,
                  hintText: hint,
                  hintStyle: const TextStyle(color: Colors.black54),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildRawDataBar(Map<String, dynamic>? rawData) {
    if (rawData == null) return const SizedBox.shrink();

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.grey.shade200,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.pink.shade300, width: 1.5),
      ),
      height: 80,
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: Text(
          jsonEncode(rawData),
          style: const TextStyle(
            fontSize: 12,
            fontFamily: 'Courier',
            color: Colors.black87,
          ),
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: PreferredSize(
        preferredSize: const Size.fromHeight(56),
        child: Container(
          height: 56,
          padding: const EdgeInsets.symmetric(horizontal: 16),
          alignment: Alignment.center,
          decoration: const BoxDecoration(
            color: Color.fromARGB(255, 255, 118, 205),
          ),
          child: Stack(
            alignment: Alignment.center,
            children: [
              Align(
                alignment: Alignment.centerLeft,
                child: IconButton(
                  icon: const Icon(Icons.arrow_back, color: Colors.white),
                  onPressed: () => Navigator.pop(context),
                ),
              ),
              Center(
                child: Text(
                  'Profil',
                  style: GoogleFonts.poppins(
                    fontSize: 20,
                    fontWeight: FontWeight.w600,
                    color: Colors.white,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : SingleChildScrollView(
              child: Column(
                children: [
                  const SizedBox(height: 24),
                  GestureDetector(
                    onTap: _pickImage,
                    child: Stack(
                      alignment: Alignment.center,
                      children: [
                        CircleAvatar(
                          radius: 60,
                          backgroundImage: _profileImage != null
                              ? FileImage(_profileImage!)
                              : const AssetImage("assets/images/profile.png")
                                  as ImageProvider,
                        ),
                        Positioned(
                          bottom: 0,
                          right: 4,
                          child: CircleAvatar(
                            backgroundColor: Colors.white,
                            radius: 18,
                            child: Icon(Icons.camera_alt,
                                color: pinkColor, size: 20),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 10),
                  Column(
                    children: [
                      Text(
                        _namaPenggunaController.text,
                        style: GoogleFonts.poppins(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Colors.black,
                        ),
                      ),
                      const SizedBox(height: 5),
                      Text(
                        _namaController.text,
                        style: GoogleFonts.poppins(
                            fontSize: 16, color: Colors.black),
                      ),
                    ],
                  ),
                  const SizedBox(height: 10),
                  _buildProfileItem("Username", _namaPenggunaController,
                      Icons.alternate_email),
                  _buildProfileItem(
                      "Nama Lengkap", _namaController, Icons.person),
                  _buildProfileItem("Email", _emailController, Icons.email),
                  _buildProfileItem(
                      "Kata Sandi", _passwordController, Icons.lock,
                      obscureText: true),
                  const SizedBox(height: 24),
                  ElevatedButton(
                    onPressed: () async {
                      final responseJson = await updateProfileOnServer();
                      if (responseJson['status'] == 'success') {
                        ScaffoldMessenger.of(context).showSnackBar(
                          const SnackBar(
                              content: Text('Profil berhasil diperbarui')),
                        );
                        setState(() {
                          // Update tampilan nama pengguna dan nama langsung
                          _namaPenggunaController.text =
                              _namaPenggunaController.text;
                          _namaController.text = _namaController.text;
                        });
                        _passwordController.clear();
                      } else {
                        ScaffoldMessenger.of(context).showSnackBar(
                          SnackBar(
                            content: Text(responseJson['message'] ??
                                'Terjadi kesalahan saat memperbarui'),
                          ),
                        );
                      }
                    },
                    style: ElevatedButton.styleFrom(
                      backgroundColor: pinkColor,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 24, vertical: 12),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                    ),
                    child: const Text("Perbarui",
                        style: TextStyle(color: Colors.white)),
                  ),
                  const SizedBox(height: 12),
                  _buildRawDataBar(_rawUserData),
                  const SizedBox(height: 24),
                ],
              ),
            ),
    );
  }
}
