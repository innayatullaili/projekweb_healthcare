<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HealthCare - Solusi Kesehatan Terpercaya</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="font-sans text-gray-900 antialiased bg-white selection:bg-primary selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-primary-light/90 backdrop-blur-md shadow-sm transition-all duration-300" x-data="{ scrolled: false }" :class="{ 'shadow-md py-2': scrolled, 'py-4': !scrolled }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-2xl font-bold text-primary tracking-tight">HealthCare.</a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#home" class="text-primary hover:text-primary-dark font-medium transition-colors">Beranda</a>
                    <a href="#about" class="text-primary/70 hover:text-primary font-medium transition-colors">Tentang</a>
                    <a href="#services" class="text-primary/70 hover:text-primary font-medium transition-colors">Layanan</a>
                    <a href="#contact" class="text-primary/70 hover:text-primary font-medium transition-colors">Kontak</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-2 border border-primary text-sm font-bold text-primary uppercase rounded-full hover:bg-primary hover:text-white transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2 border border-primary text-sm font-bold text-primary uppercase rounded-full hover:bg-primary hover:text-white transition-all duration-300">
                            Masuk
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button (Hamburger) -->
                <div class="md:hidden flex items-center">
                    <button class="text-primary focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">
                <!-- Text Content -->
                <div class="flex-1 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <span class="inline-block py-1 px-3 rounded-full bg-primary-light text-primary text-xs font-bold tracking-wider uppercase mb-6">
                        Selamat Datang di HealthCare
                    </span>
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Kesehatan Anda Adalah <span class="text-primary">Prioritas Utama</span> Kami
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Kami menyediakan layanan kesehatan terpadu dengan tenaga medis profesional yang siap membantu Anda mencapai kualitas hidup yang lebih baik.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-primary/30">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M2.004 22.003L4.99 11.054A9.957 9.957 0 012.825 5.86c0-5.525 4.545-10 10.155-10 2.7 0 5.255 1.045 7.155 2.945 1.9 1.9 2.945 4.455 2.945 7.155 0 5.525-4.545 10-10.155 10-1.755 0-3.415-.45-4.87-1.22L2.004 22.003z"/></svg>
                                Buat Janji Sekarang
                            </a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-primary/30">
                                Ke Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
                <!-- Image/Illustration -->
                <div class="flex-1 w-full max-w-lg lg:max-w-full" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('assets/landing/image-1.png') }}" alt="Medical Healthcare" class="w-full h-auto drop-shadow-2xl animate-float">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-primary-ultra-light">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-primary font-bold tracking-widest uppercase text-sm">Layanan Kami</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-2">Bagaimana kami bisa membantu Anda?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Cards -->
                @foreach($services as $service)
                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:border-primary/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="w-12 h-12 bg-primary-light rounded-full flex items-center justify-center mb-6 group-hover:bg-primary transition-colors">
                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $service['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white overflow-hidden" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Image -->
                <div class="relative w-full lg:w-1/2">
                    <div class="absolute -top-4 -left-4 w-full h-full bg-primary-light/50 rounded-3xl -z-10 transform scale-105"></div>
                    <img src="{{ asset('assets/landing/happy-doctor-holding-a-clipboard-with-patients.png') }}" alt="About HealthCare" class="w-full rounded-2xl shadow-lg">
                </div>
                <!-- Content -->
                <div class="w-full lg:w-1/2">
                    <span class="text-primary font-bold tracking-widest uppercase text-sm">Tentang Kami</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-2 mb-6">Mengapa Memilih HealthCare?</h2>
                    <div class="prose prose-lg text-gray-600">
                        <p class="mb-4">
                            HealthCare hadir sebagai solusi kesehatan modern yang mengutamakan kenyamanan dan kualitas pelayanan. Kami percaya bahwa akses kesehatan yang baik adalah hak setiap individu.
                        </p>
                        <p>
                            Dengan tim dokter berpengalaman dan fasilitas yang memadai, kami berkomitmen untuk memberikan diagnosa yang tepat dan rencana perawatan yang personal untuk setiap pasien.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section (New) -->
    <section id="doctors" class="py-24 bg-primary-ultra-light" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
             <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary font-bold tracking-widest uppercase text-sm">Tim Kami</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-2">Dokter Profesional Kami</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($doctors as $doctor)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="h-48 bg-primary-light/30 flex items-center justify-center">
                        <!-- Placeholder Avatar (We will update this in the next step) -->
                        <div class="w-24 h-24 bg-primary-light rounded-full flex items-center justify-center text-primary text-2xl font-bold">
                            {{ substr($doctor->user->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-gray-900">{{ $doctor->user->name }}</h3>
                        <p class="text-primary text-sm font-medium mb-4">Dokter Spesialis</p>
                        <a href="{{ route('login') }}" class="inline-block px-6 py-2 border border-primary text-primary rounded-full hover:bg-primary hover:text-white transition-colors text-sm font-semibold">Buat Janji</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-gradient-to-b from-white to-gray-50" data-aos="zoom-in">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-16">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                    <p class="text-lg text-gray-600 mb-8">Punya pertanyaan atau ingin berkonsultasi? Jangan ragu untuk menghubungi kami.</p>
                    
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition-all duration-300 shadow-lg shadow-primary/30 mb-8">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M2.004 22.003L4.99 11.054A9.957 9.957 0 012.825 5.86c0-5.525 4.545-10 10.155-10 2.7 0 5.255 1.045 7.155 2.945 1.9 1.9 2.945 4.455 2.945 7.155 0 5.525-4.545 10-10.155 10-1.755 0-3.415-.45-4.87-1.22L2.004 22.003z"/></svg>
                            Buat Janji Temu
                        </a>
                    @else
                         <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition-all duration-300 shadow-lg shadow-primary/30 mb-8">
                            Ke Dashboard
                        </a>
                    @endguest

                    <div class="space-y-4">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-6 h-6 text-primary mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            contact@healthcare.com
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-6 h-6 text-primary mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jl. Amauri Souza, 346, Jakarta
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative">
                     <div class="absolute -bottom-4 -right-4 w-full h-full bg-primary-light/50 rounded-3xl -z-10 transform scale-105"></div>
                    <img src="{{ asset('assets/landing/image.png') }}" alt="Contact Us" class="w-full rounded-2xl shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-12" data-aos="fade-in">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-bold mb-2">HealthCare.</h3>
                <p class="text-primary-light/80 text-sm">© 2025 HealthCare. Hak cipta dilindungi undang-undang.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white/80 transition-colors"><img src="{{ asset('assets/landing/instagram-1.svg') }}" class="w-6 h-6 brightness-0 invert" alt="IG"></a>
                <a href="#" class="hover:text-white/80 transition-colors"><img src="{{ asset('assets/landing/facebook-1.svg') }}" class="w-6 h-6 brightness-0 invert" alt="FB"></a>
                <a href="#" class="hover:text-white/80 transition-colors"><img src="{{ asset('assets/landing/youtube-1.svg') }}" class="w-6 h-6 brightness-0 invert" alt="YT"></a>
            </div>
        </div>
    </footer>

    <style>
        /* Custom Animation for Float */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
        });
    </script>
</body>
</html>
