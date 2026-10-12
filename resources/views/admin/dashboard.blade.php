<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats & Welcome Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Welcome Card -->
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-2">Selamat datang, Administrator! 👋</h3>
                        <p class="text-gray-600">
                            Anda memiliki akses penuh ke sistem. Gunakan menu di samping untuk mengelola data master.
                        </p>
                    </div>
                </div>

                <!-- Simple Stat Card (Example) -->
                <div class="bg-primary text-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold">{{ \App\Models\User::count() }}</span>
                        <span class="text-primary-light text-sm font-medium">Total Pengguna</span>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Statistik Kunjungan (7 Hari Terakhir)</h3>
                </div>
                <div class="p-6">
                    <div class="w-full h-64 md:h-80">
                        <canvas id="appointmentsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Management Menu -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Users -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Users</h4>
                    <p class="text-sm text-gray-500 mb-4">Kelola akun pengguna & admin.</p>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-primary font-semibold hover:underline">Kelola User →</a>
                </div>

                <!-- Doctors -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Dokter & Jadwal</h4>
                    <p class="text-sm text-gray-500 mb-4">Atur slot waktu konsultasi.</p>
                    <a href="{{ route('admin.doctors.index') }}" class="text-sm text-primary font-semibold hover:underline">Kelola Dokter →</a>
                </div>

                <!-- Roles -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Role & Izin</h4>
                    <p class="text-sm text-gray-500 mb-4">Konfigurasi hak akses sistem.</p>
                    <a href="{{ route('admin.user-roles.index') }}" class="text-sm text-primary font-semibold hover:underline">Kelola Roles →</a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('appointmentsChart').getContext('2d');
            
            // Data from Controller
            const labels = @json($labels ?? []);
            const data = @json($data ?? []);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Janji Temu',
                        data: data,
                        borderColor: '#00856f',
                        backgroundColor: 'rgba(0, 133, 111, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#00856f',
                        pointHoverBackgroundColor: '#00856f',
                        pointHoverBorderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            titleFont: { size: 13 },
                            bodyFont: { size: 12 }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4],
                                color: '#e5e7eb'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
