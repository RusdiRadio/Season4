import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/pengguna_model.dart';

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000/api';

  static Future<Pengguna?> fetchPenggunaById(int id) async {
    final url = Uri.parse('$baseUrl/pengguna/$id');

    try {
      final response = await http.get(url);

      if (response.statusCode == 200) {
        final body = json.decode(response.body);
        final data = body['data'];
        return Pengguna.fromJson(data);
      } else {
        print('Gagal mengambil data. Status code: ${response.statusCode}');
        return null;
      }
    } catch (e) {
      print('Error: $e');
      return null;
    }
  }
}
