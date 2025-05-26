import 'dart:io';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:image_picker/image_picker.dart';
import 'package:google_fonts/google_fonts.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  bool _isEditing = false;
  File? _profileImage;
  final picker = ImagePicker();

  final TextEditingController _namaPenggunaController = TextEditingController();
  final TextEditingController _namaController = TextEditingController();
  final TextEditingController _usiaController = TextEditingController();
  final TextEditingController _tanggalLahirController = TextEditingController();
  final TextEditingController _alamatController = TextEditingController();
  final TextEditingController _noHpController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();

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
      final prefs = await SharedPreferences.getInstance();
      await prefs.setString('profileImage', pickedFile.path);
    }
  }

  Future<void> _loadProfileData() async {
    final prefs = await SharedPreferences.getInstance();
    _namaPenggunaController.text = prefs.getString('namaPengguna') ?? "";
    _namaController.text = prefs.getString('nama') ?? "";
    _usiaController.text = prefs.getString('usia') ?? "";
    _tanggalLahirController.text = prefs.getString('tanggalLahir') ?? "";
    _alamatController.text = prefs.getString('alamat') ?? "";
    _noHpController.text = prefs.getString('noHp') ?? "+62";
    _passwordController.text = prefs.getString('password') ?? "********";

    String? imagePath = prefs.getString('profileImage');
    if (imagePath != null && File(imagePath).existsSync()) {
      setState(() {
        _profileImage = File(imagePath);
      });
    }
  }

  Future<void> _saveProfileData() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('namaPengguna', _namaPenggunaController.text);
    await prefs.setString('nama', _namaController.text);
    await prefs.setString('usia', _usiaController.text);
    await prefs.setString('tanggalLahir', _tanggalLahirController.text);
    await prefs.setString('alamat', _alamatController.text);
    await prefs.setString('noHp', _noHpController.text);
    await prefs.setString('password', _passwordController.text);
  }

  void _toggleEdit() {
    setState(() {
      _isEditing = !_isEditing;
    });
  }

  Widget _buildProfileItem(String hint, TextEditingController controller, IconData icon,
      {bool obscureText = false}) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
        decoration: BoxDecoration(
          color: Colors.grey.withOpacity(0.1),
          borderRadius: BorderRadius.circular(12), // tidak terlalu tumpul
        ),
        child: Row(
          children: [
            Icon(icon, color: Colors.black),
            const SizedBox(width: 12),
            Expanded(
              child: _isEditing
                  ? TextField(
                      controller: controller,
                      obscureText: obscureText,
                      style: const TextStyle(color: Colors.black),
                      decoration: InputDecoration(
                        border: InputBorder.none,
                        hintText: hint,
                        hintStyle: const TextStyle(color: Colors.black54),
                      ),
                    )
                  : Padding(
                      padding: const EdgeInsets.symmetric(vertical: 16.0),
                      child: Text(
                        controller.text,
                        style: const TextStyle(color: Colors.black, fontSize: 16),
                      ),
                    ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildActionButton(String label, IconData icon, VoidCallback onTap) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        margin: const EdgeInsets.only(top: 12),
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
        decoration: BoxDecoration(
          color: Colors.grey.withOpacity(0.1),
          borderRadius: BorderRadius.circular(12), // tidak terlalu tumpul
        ),
        child: Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            Icon(icon, color: Colors.black),
            const SizedBox(width: 8),
            Text(
              label,
              style: GoogleFonts.poppins(
                fontSize: 16,
                fontWeight: FontWeight.w500,
                color: Colors.black,
              ),
            ),
          ],
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
      body: SingleChildScrollView(
        child: Column(
          children: [
            const SizedBox(height: 24),
            Center(
              child: GestureDetector(
                onTap: _isEditing ? _pickImage : null,
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
                    if (_isEditing)
                      Positioned(
                        bottom: 0,
                        right: 4,
                        child: CircleAvatar(
                          backgroundColor: Colors.white,
                          radius: 18,
                          child: const Icon(Icons.camera_alt, color: Colors.pink, size: 20),
                        ),
                      ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 10),
            Center(
              child: Column(
                children: [
                  Text(
                    _namaPenggunaController.text,
                    style: GoogleFonts.poppins(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: Colors.black,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 5),
                  Text(
                    _namaController.text,
                    style: GoogleFonts.poppins(fontSize: 16, color: Colors.black),
                    textAlign: TextAlign.center,
                  ),
                ],
              ),
            ),
            const SizedBox(height: 10),
            _buildActionButton("Edit Profile", Icons.edit, _toggleEdit),
            if (_isEditing) ...[
              _buildProfileItem("Nama Pengguna", _namaPenggunaController, Icons.alternate_email),
              _buildProfileItem("Nama Lengkap", _namaController, Icons.person),
              _buildProfileItem("Usia", _usiaController, Icons.cake),
              _buildProfileItem("Tanggal Lahir", _tanggalLahirController, Icons.event),
              _buildProfileItem("Alamat", _alamatController, Icons.location_on),
              _buildProfileItem("Nomor HP", _noHpController, Icons.phone),
              _buildProfileItem("Kata Sandi", _passwordController, Icons.lock, obscureText: true),
              const SizedBox(height: 24),
              ElevatedButton(
                onPressed: () async {
                  await _saveProfileData();
                  setState(() {
                    _isEditing = false;
                  });
                  ScaffoldMessenger.of(context).showSnackBar(
                    const SnackBar(content: Text("Data berhasil disimpan")),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.pink,
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12), // tidak terlalu tumpul
                  ),
                ),
                child: const Text("Simpan", style: TextStyle(color: Colors.white)),
              ),
              const SizedBox(height: 16),
            ],
            _buildActionButton("Log Out", Icons.logout, () async {
              final prefs = await SharedPreferences.getInstance();
              await prefs.clear();
              Navigator.pushReplacementNamed(context, '/main.dart');
            }),
            const SizedBox(height: 24),
          ],
        ),
      ),
    );
  }
}
