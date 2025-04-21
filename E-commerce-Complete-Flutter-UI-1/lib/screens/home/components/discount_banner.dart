import 'dart:async';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class DateTimeBanner extends StatefulWidget {
  const DateTimeBanner({Key? key}) : super(key: key);

  @override
  _DateTimeBannerState createState() => _DateTimeBannerState();
}

class _DateTimeBannerState extends State<DateTimeBanner> {
  late String formattedDate;
  late String formattedTime;
  late Timer timer;

  @override
  void initState() {
    super.initState();
    _updateTime();
    timer =
        Timer.periodic(const Duration(seconds: 1), (Timer t) => _updateTime());
  }

  void _updateTime() {
    setState(() {
      DateTime now = DateTime.now();
      formattedDate = DateFormat('EEEE, dd MMMM yyyy').format(now);
      formattedTime = DateFormat('HH:mm:ss').format(now);
    });
  }

  @override
  void dispose() {
    timer.cancel();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      margin: const EdgeInsets.all(20),
      padding: const EdgeInsets.symmetric(
        horizontal: 20,
        vertical: 16,
      ),
      decoration: BoxDecoration(
        color: const Color.fromARGB(255, 195, 0, 0),
        borderRadius: BorderRadius.circular(20),
      ),
      child: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Text(
              formattedDate,
              textAlign: TextAlign.center,
              style: const TextStyle(
                fontSize: 18,
                color: Colors.white,
              ),
            ),
            const SizedBox(height: 5),
            Text(
              formattedTime,
              textAlign: TextAlign.center,
              style: const TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
                color: Colors.white,
              ),
            ),
          ],
        ),
      ),
    );
  }
}
