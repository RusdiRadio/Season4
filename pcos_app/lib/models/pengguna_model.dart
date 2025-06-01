class Pengguna {
  final int? id;
  final String username;
  final String nama;
  final String email;

  Pengguna({
    this.id,
    required this.username,
    required this.nama,
    required this.email,
  });

  factory Pengguna.fromJson(Map<String, dynamic> json) {
    return Pengguna(
      id: json['id'],
      username: json['username'],
      nama: json['nama'],
      email: json['email'],
    );
  }
}
