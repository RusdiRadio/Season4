import 'package:flutter/material.dart';

class BottomNavBar extends StatefulWidget {
  final int currentIndex;
  final Function(int) onTap;

  const BottomNavBar({
    super.key,
    required this.currentIndex,
    required this.onTap,
  });

  @override
  State<BottomNavBar> createState() => _BottomNavBarState();
}

class _BottomNavBarState extends State<BottomNavBar>
    with TickerProviderStateMixin {
  late List<AnimationController> _controllers;
  late List<Animation<double>> _scaleAnimations;
  late List<Animation<double>> _slideAnimations;

  @override
  void initState() {
    super.initState();
    _controllers = List.generate(
      4,
      (index) => AnimationController(
        duration: const Duration(milliseconds: 200),
        vsync: this,
      ),
    );

    _scaleAnimations = _controllers
        .map((controller) => Tween<double>(begin: 1.0, end: 1.2).animate(
              CurvedAnimation(parent: controller, curve: Curves.easeInOut),
            ))
        .toList();

    _slideAnimations = _controllers
        .map((controller) => Tween<double>(begin: 0.0, end: -4.0).animate(
              CurvedAnimation(parent: controller, curve: Curves.easeInOut),
            ))
        .toList();

    // Animate current selected item
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _controllers[widget.currentIndex].forward();
    });
  }

  @override
  void didUpdateWidget(BottomNavBar oldWidget) {
    super.didUpdateWidget(oldWidget);
    if (oldWidget.currentIndex != widget.currentIndex) {
      _controllers[oldWidget.currentIndex].reverse();
      _controllers[widget.currentIndex].forward();
    }
  }

  @override
  void dispose() {
    for (var controller in _controllers) {
      controller.dispose();
    }
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 90,
      decoration: BoxDecoration(
        gradient: const LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          colors: [
            Color(0xFFFF76CD), // pink muda pengganti abu-abu sebelumnya
            Color(0xFFFF76CD), // pink muda pengganti abu-abu sebelumnya
          ],
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.08),
            blurRadius: 32,
            offset: const Offset(0, -8),
            spreadRadius: 0,
          ),
          BoxShadow(
            color: const Color(0xFFD81B60).withOpacity(0.04),
            blurRadius: 16,
            offset: const Offset(0, -4),
            spreadRadius: 0,
          ),
        ],
        border: Border(
          top: BorderSide(
            color: const Color(0xFFFF76CD), // pink pengganti Colors.grey[100]
            width: 0.5,
          ),
        ),
      ),
      child: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              _buildNavItem(0, Icons.home_rounded, 'Home'),
              _buildNavItem(1, Icons.notifications_active_rounded, 'Notifikasi'),
              _buildNavItem(2, Icons.monitor_weight_outlined, 'BMI'),
              _buildNavItem(3, Icons.person_rounded, 'Profil'),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildNavItem(int index, IconData icon, String label) {
    final isSelected = widget.currentIndex == index;

    return Expanded(
      child: GestureDetector(
        onTap: () => widget.onTap(index),
        behavior: HitTestBehavior.opaque,
        child: AnimatedBuilder(
          animation: Listenable.merge([
            _scaleAnimations[index],
            _slideAnimations[index],
          ]),
          builder: (context, child) {
            return Transform.translate(
              offset: Offset(0, _slideAnimations[index].value),
              child: Transform.scale(
                scale: _scaleAnimations[index].value,
                child: Container(
                  height: 64,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    gradient: isSelected
                        ? LinearGradient(
                            begin: Alignment.topLeft,
                            end: Alignment.bottomRight,
                            colors: [
                              const Color(0xFFD81B60).withOpacity(0.1),
                              const Color(0xFFAD1457).withOpacity(0.05),
                            ],
                          )
                        : null,
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      // Icon with luxury container
                      Container(
                        width: 32,
                        height: 32,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(10),
                          gradient: isSelected
                              ? const LinearGradient(
                                  begin: Alignment.topLeft,
                                  end: Alignment.bottomRight,
                                  colors: [
                                    Color(0xFFD81B60),
                                    Color(0xFFAD1457),
                                  ],
                                )
                              : null,
                          boxShadow: isSelected
                              ? [
                                  BoxShadow(
                                    color: const Color(0xFFD81B60).withOpacity(0.3),
                                    blurRadius: 12,
                                    offset: const Offset(0, 4),
                                    spreadRadius: 0,
                                  ),
                                ]
                              : null,
                        ),
                        child: Icon(
                          icon,
                          size: 18,
                          color: isSelected 
                              ? Colors.white 
                              : const Color.fromARGB(255, 255, 255, 255),
                        ),
                      ),

                      const SizedBox(height: 6),

                      // Label with elegant typography
                      AnimatedDefaultTextStyle(
                        duration: const Duration(milliseconds: 200),
                        style: TextStyle(
                          fontSize: isSelected ? 11 : 10,
                          fontWeight: isSelected ? FontWeight.w600 : FontWeight.w400,
                          color: isSelected 
                              ? const Color(0xFFD81B60) 
                              : const Color.fromARGB(255, 255, 255, 255),
                          letterSpacing: 0.3,
                        ),
                        child: Text(label),
                      ),

                      const SizedBox(height: 2),
                      // Active indicator dot
                      AnimatedContainer(
                        duration: const Duration(milliseconds: 200),
                        width: isSelected ? 4 : 0,
                        height: isSelected ? 4 : 0,
                        decoration: BoxDecoration(
                          color: const Color(0xFFD81B60),
                          borderRadius: BorderRadius.circular(2),
                          boxShadow: isSelected
                              ? [
                                  BoxShadow(
                                    color: const Color(0xFFD81B60).withOpacity(0.4),
                                    blurRadius: 4,
                                    spreadRadius: 1,
                                  ),
                                ]
                              : null,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            );
          },
        ),
      ),
    );
  }
}
