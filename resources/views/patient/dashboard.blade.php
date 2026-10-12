<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Hero -->
            <div class="bg-gradient-to-r from-primary to-primary-dark rounded-2xl shadow-lg p-6 md:p-10 mb-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-primary-light opacity-90 max-w-2xl text-lg">
                        Jaga kesehatan Anda bersama kami. Buat janji temu dengan dokter spesialis atau pantau riwayat kesehatan Anda dengan mudah.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('patient.appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary font-bold rounded-lg shadow-md hover:bg-gray-50 transition transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Buat Janji Baru
                        </a>
                    </div>
                </div>
                <!-- Decorative Circle -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-20 w-32 h-32 bg-primary-light opacity-20 rounded-full blur-2xl"></div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Appointment History -->
                <a href="{{ route('patient.appointments.index') }}" class="group bg-white overflow-hidden shadow-md rounded-xl border border-gray-100 p-6 hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-right">
                           <p class="text-sm font-medium text-gray-500">Janji Temu</p>
                           <!-- Optional: Count if passed from controller, else generic text -->
                           <p class="text-xs text-gray-400 mt-1">Lihat status & jadwal</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-lg font-bold text-gray-800 group-hover:text-primary transition-colors">Riwayat Konsultasi</h4>
                        <p class="text-sm text-gray-500 mt-1">Cek jadwal mendatang dan riwayat selesai.</p>
                    </div>
                </a>

                <!-- Medical Records -->
                <a href="{{ route('patient.medical-records.index') }}" class="group bg-white overflow-hidden shadow-md rounded-xl border border-gray-100 p-6 hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg group-hover:bg-purple-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                         <div class="text-right">
                           <p class="text-sm font-medium text-gray-500">Rekam Medis</p>
                           <p class="text-xs text-gray-400 mt-1">Diagnosis & Resep</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-lg font-bold text-gray-800 group-hover:text-primary transition-colors">Catatan Kesehatan</h4>
                        <p class="text-sm text-gray-500 mt-1">Akses riwayat diagnosis dan resep obat Anda.</p>
                    </div>
                </a>

                <!-- Notifications -->
                <a href="{{ route('patient.notifications.index') }}" class="group bg-white overflow-hidden shadow-md rounded-xl border border-gray-100 p-6 hover:shadow-xl hover:border-primary/30 transition-all duration-300">
                     <div class="flex items-start justify-between">
                        <div class="p-3 bg-orange-50 text-orange-600 rounded-lg group-hover:bg-orange-100 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                         <div class="text-right">
                           <p class="text-sm font-medium text-gray-500">Kotak Masuk</p>
                           <p class="text-xs text-gray-400 mt-1">Pemberitahuan</p>
                        </div>
                    </div>
                     <div class="mt-4">
                        <h4 class="text-lg font-bold text-gray-800 group-hover:text-primary transition-colors">Notifikasi</h4>
                        <p class="text-sm text-gray-500 mt-1">Informasi terbaru seputar janji temu Anda.</p>
                    </div>
                </a>
            </div>

            <!-- Help Section -->
            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-full mr-4 text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h5 class="font-bold text-gray-800">Butuh Bantuan?</h5>
                        <p class="text-sm text-gray-600">Jika Anda mengalami kendala dalam pembayaran atau pendaftaran, hubungi admin.</p>
                    </div>
                </div>
                 <!-- Optional: Link to contact/help if exists, otherwise static -->
            </div>

        </div>
    </div>
</x-app-layout>
