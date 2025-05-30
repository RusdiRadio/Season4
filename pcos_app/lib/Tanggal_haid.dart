import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class TanggalHaid extends StatefulWidget {
  const TanggalHaid({super.key});

  @override
  State<TanggalHaid> createState() => _TanggalHaidState();
}

class _TanggalHaidState extends State<TanggalHaid>
    with TickerProviderStateMixin {
  DateTime? selectedHaidDate;
  late AnimationController _fadeController;
  late AnimationController _scaleController;
  late Animation<double> _fadeAnimation;
  late Animation<double> _scaleAnimation;

  @override
  void initState() {
    super.initState();
    _fadeController = AnimationController(
      duration: const Duration(milliseconds: 800),
      vsync: this,
    );
    _scaleController = AnimationController(
      duration: const Duration(milliseconds: 400),
      vsync: this,
    );

    _fadeAnimation = Tween<double>(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(parent: _fadeController, curve: Curves.easeInOut),
    );

    _scaleAnimation = Tween<double>(begin: 0.8, end: 1.0).animate(
      CurvedAnimation(parent: _scaleController, curve: Curves.elasticOut),
    );

    _fadeController.forward();
    _scaleController.forward();
  }

  @override
  void dispose() {
    _fadeController.dispose();
    _scaleController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final now = DateTime.now();
    final dateFormat = DateFormat('EEEE, d MMMM y', 'id_ID');

    bool isHaid(DateTime date) {
      if (selectedHaidDate == null) return false;
      final endHaid = selectedHaidDate!.add(const Duration(days: 6));
      return date
              .isAfter(selectedHaidDate!.subtract(const Duration(days: 1))) &&
          date.isBefore(endHaid.add(const Duration(days: 1)));
    }

    return FadeTransition(
      opacity: _fadeAnimation,
      child: Column(
        children: [
          const SizedBox(height: 24),

          const SizedBox(height: 8),

          // Premium Date Picker Button
          ScaleTransition(
            scale: _scaleAnimation,
            child: GestureDetector(
              onTap: () async {
                // Haptic feedback
                // HapticFeedback.lightImpact();

                final pickedDate = await showDatePicker(
                  context: context,
                  initialDate: selectedHaidDate ?? DateTime.now(),
                  firstDate: DateTime(2000),
                  lastDate: DateTime(2100),
                  locale: const Locale('id', 'ID'),
                  builder: (context, child) {
                    return Theme(
                      data: Theme.of(context).copyWith(
                        colorScheme: ColorScheme.light(
                          primary: const Color(0xFFD81B60),
                          onPrimary: Colors.white,
                          onSurface: Colors.grey[800]!,
                          surface: Colors.white,
                        ),
                        textButtonTheme: TextButtonThemeData(
                          style: TextButton.styleFrom(
                            foregroundColor: const Color(0xFFD81B60),
                            textStyle: const TextStyle(
                              fontWeight: FontWeight.w500,
                              letterSpacing: 0.5,
                            ),
                          ),
                        ),
                        dialogBackgroundColor: Colors.white,
                        datePickerTheme: DatePickerThemeData(
                          backgroundColor: Colors.white,
                          elevation: 8,
                          surfaceTintColor: Colors.white,
                          headerBackgroundColor: const Color(0xFFD81B60),
                          headerForegroundColor: Colors.white,
                          weekdayStyle: TextStyle(
                            color: Colors.grey[500],
                            fontWeight: FontWeight.w400,
                            fontSize: 12,
                          ),
                          dayStyle: const TextStyle(
                            fontWeight: FontWeight.w400,
                            fontSize: 13,
                          ),
                          todayBackgroundColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.selected)) {
                              return const Color(0xFFD81B60);
                            }
                            return Colors.grey[100];
                          }),
                          todayForegroundColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.selected)) {
                              return Colors.white;
                            }
                            return const Color(0xFFD81B60);
                          }),
                          dayBackgroundColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.selected)) {
                              return const Color(0xFFD81B60);
                            }
                            return null;
                          }),
                          shape: const RoundedRectangleBorder(
                            borderRadius: BorderRadius.all(Radius.circular(16)),
                          ),
                          headerHeadlineStyle: const TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.w400,
                            letterSpacing: 0.2,
                          ),
                          headerHelpStyle: const TextStyle(
                            fontSize: 14,
                            fontWeight: FontWeight.w400,
                            letterSpacing: 0.2,
                          ),
                          dayOverlayColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.hovered)) {
                              return const Color(0xFFD81B60).withOpacity(0.1);
                            }
                            return null;
                          }),
                          yearStyle: TextStyle(
                            color: Colors.grey[700],
                            fontSize: 14,
                          ),
                          yearBackgroundColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.selected)) {
                              return const Color(0xFFD81B60);
                            }
                            return null;
                          }),
                          yearForegroundColor:
                              MaterialStateProperty.resolveWith((states) {
                            if (states.contains(MaterialState.selected)) {
                              return Colors.white;
                            }
                            return Colors.grey[700];
                          }),
                        ),
                      ),
                      child: child!,
                    );
                  },
                );

                if (pickedDate != null) {
                  setState(() {
                    selectedHaidDate = pickedDate;
                  });
                  _scaleController.reset();
                  _scaleController.forward();
                }
              },
              child: Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
                margin: const EdgeInsets.symmetric(horizontal: 24),
                decoration: BoxDecoration(
                  gradient: const LinearGradient(
                    colors: [Color(0xFFD81B60), Color(0xFFAD1457)],
                    begin: Alignment.topLeft,
                    end: Alignment.bottomRight,
                  ),
                  borderRadius: BorderRadius.circular(12),
                  boxShadow: [
                    BoxShadow(
                      color: const Color(0xFFD81B60).withOpacity(0.4),
                      blurRadius: 20,
                      offset: const Offset(0, 8),
                      spreadRadius: 0,
                    ),
                    BoxShadow(
                      color: Colors.white.withOpacity(0.1),
                      blurRadius: 0,
                      offset: const Offset(0, 1),
                      spreadRadius: 0,
                    ),
                  ],
                ),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Container(
                      padding: const EdgeInsets.all(5),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.15),
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: const Icon(Icons.calendar_today_rounded,
                          color: Colors.white, size: 14),
                    ),
                    const SizedBox(width: 8),
                    const Text(
                      "Pilih Tanggal Haid",
                      style: TextStyle(
                        fontWeight: FontWeight.w500,
                        fontSize: 14,
                        color: Colors.white,
                        letterSpacing: 0.3,
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),

          const SizedBox(height: 24),

          // Premium Status Card
          Container(
            margin: const EdgeInsets.symmetric(horizontal: 24),
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(20),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.06),
                  blurRadius: 20,
                  offset: const Offset(0, 8),
                  spreadRadius: 0,
                ),
              ],
            ),
            child: Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(20),
                gradient: LinearGradient(
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                  colors: [
                    Colors.white,
                    Colors.grey[50]!.withOpacity(0.3),
                  ],
                ),
              ),
              child: _buildLuxuryTanggalTile(
                "Hari Ini",
                dateFormat.format(now),
                isHaid(now),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildLuxuryTanggalTile(
      String label, String tanggal, bool isHaidFase) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        // Date Icon Container
        Container(
          width: 40,
          height: 40,
          decoration: BoxDecoration(
            gradient: LinearGradient(
              colors: isHaidFase
                  ? [const Color(0xFFD81B60), const Color(0xFFAD1457)]
                  : [Colors.grey[300]!, Colors.grey[400]!],
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
            ),
            borderRadius: BorderRadius.circular(10),
            boxShadow: [
              BoxShadow(
                color:
                    (isHaidFase ? const Color(0xFFD81B60) : Colors.grey[400]!)
                        .withOpacity(0.15),
                blurRadius: 6,
                offset: const Offset(0, 3),
              ),
            ],
          ),
          child: Icon(
            Icons.today_rounded,
            color: Colors.white,
            size: 18,
          ),
        ),

        const SizedBox(width: 14),

        // Date Information
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: TextStyle(
                  color:
                      isHaidFase ? const Color(0xFFD81B60) : Colors.grey[600],
                  fontSize: 14,
                  fontWeight: FontWeight.w500,
                  letterSpacing: 0.5,
                ),
              ),
              const SizedBox(height: 6),
              Text(
                tanggal,
                style: TextStyle(
                  color: Colors.grey[800],
                  fontSize: 18,
                  fontWeight: FontWeight.w400,
                  letterSpacing: 0.3,
                ),
              ),
            ],
          ),
        ),

        // Status Badge
        if (isHaidFase)
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                colors: [Color(0xFFD81B60), Color(0xFFAD1457)],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
              borderRadius: BorderRadius.circular(20),
              boxShadow: [
                BoxShadow(
                  color: const Color(0xFFD81B60).withOpacity(0.3),
                  blurRadius: 8,
                  offset: const Offset(0, 4),
                ),
              ],
            ),
            child: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                Container(
                  width: 6,
                  height: 6,
                  decoration: const BoxDecoration(
                    color: Colors.white,
                    shape: BoxShape.circle,
                  ),
                ),
                const SizedBox(width: 8),
                const Text(
                  "Fase Haid",
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 12,
                    fontWeight: FontWeight.w500,
                    letterSpacing: 0.5,
                  ),
                ),
              ],
            ),
          ),
      ],
    );
  }
}
