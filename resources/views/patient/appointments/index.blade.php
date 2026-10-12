<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Janji Temu Saya') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola jadwal konsultasi dan riwayat pembayaran Anda.</p>
            </div>
            <a href="{{ route('patient.appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mt-4 md:mt-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Janji Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ 
        search: '', 
        loaded: false,
        sortCol: null,
        sortAsc: true,
        init() { 
            setTimeout(() => this.loaded = true, 300); 
        },
        sortTable(colIndex) {
            this.sortAsc = (this.sortCol === colIndex) ? !this.sortAsc : true;
            this.sortCol = colIndex;
            let rows = Array.from(this.$refs.tableBody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                let textA = a.children[colIndex].textContent.trim().toLowerCase();
                let textB = b.children[colIndex].textContent.trim().toLowerCase();
                return this.sortAsc ? textA.localeCompare(textB) : textB.localeCompare(textA);
            });
            
            this.$refs.tableBody.append(...rows);
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    
                    <!-- Toolbar -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Janji Temu</h3>
                        
                        <!-- Search Bar -->
                        <div class="relative w-full md:w-64">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input x-model="search" type="text" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-150 ease-in-out" placeholder="Cari dokter, status...">
                        </div>
                    </div>

                    @if($appointments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <!-- Sortable Headers -->
                                        <th @click="sortTable(0)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                ID
                                                <svg :class="{'rotate-180': sortCol === 0 && !sortAsc, 'text-primary': sortCol === 0}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <th @click="sortTable(1)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Dokter
                                                <svg :class="{'rotate-180': sortCol === 1 && !sortAsc, 'text-primary': sortCol === 1}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <th @click="sortTable(2)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Waktu
                                                <svg :class="{'rotate-180': sortCol === 2 && !sortAsc, 'text-primary': sortCol === 2}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Biaya</th>
                                        <th @click="sortTable(4)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Status
                                                <svg :class="{'rotate-180': sortCol === 4 && !sortAsc, 'text-primary': sortCol === 4}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <!-- Skeleton Loader -->
                                <tbody class="bg-white divide-y divide-gray-200" x-show="!loaded">
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr class="animate-pulse">
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-16"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-40"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-32"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-full"></div></td>
                                    </tr>
                                    @endfor
                                </tbody>

                                <tbody class="bg-white divide-y divide-gray-200" x-show="loaded" x-ref="tableBody" style="display: none;">
                                    @foreach($appointments as $appointment)
                                        @php
                                            $schedule = $appointment->schedule;
                                            $scheduledDateValue = $appointment->date; // Direct fallback to date column if using simplified model, checking logic
                                            // Fallback logic from original file
                                            $sDate = $schedule?->date ?? $appointment->date; // Assuming logic matches original
                                            $startT = $schedule?->start_time ?? $appointment->start_time;
                                            $endT = $schedule?->end_time ?? $appointment->end_time;
                                            
                                            $carbonDate = $sDate ? \Illuminate\Support\Carbon::parse($sDate) : null;
                                        @endphp
                                        <tr class="hover:bg-gray-50 transition-colors duration-200" x-show="!search || $el.innerText.toLowerCase().includes(search.toLowerCase())" x-transition>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                                                #{{ $appointment->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-primary-light flex items-center justify-center text-primary font-bold text-xs">
                                                            {{ strtoupper(substr(optional(optional($appointment->doctor)->user)->name ?? '?', 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ optional(optional($appointment->doctor)->user)->name ?? '-' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ $appointment->doctor->specialization ?? 'Dokter Umum' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    {{ $carbonDate ? $carbonDate->format('d M Y') : '-' }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $startT ? \Illuminate\Support\Carbon::parse($startT)->format('H:i') : '-' }} - 
                                                    {{ $endT ? \Illuminate\Support\Carbon::parse($endT)->format('H:i') : '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                                Rp {{ number_format($appointment->consultation_fee ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col space-y-1">
                                                     <!-- Appointment Status -->
                                                    <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full w-max
                                                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                        {{ $appointment->status === 'scheduled' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                        {{ ucfirst($appointment->status ?? 'scheduled') }}
                                                    </span>
                                                    
                                                    <!-- Payment Status -->
                                                    @if($appointment->payment_status === 'paid')
                                                        <span class="text-xs text-green-600 font-bold flex items-center">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Lunas
                                                        </span>
                                                    @elseif($appointment->payment_status === 'pending')
                                                        <span class="text-xs text-yellow-600 font-bold flex items-center">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Menunggu Bayar
                                                        </span>
                                                    @elseif($appointment->payment_status === 'failed')
                                                        <span class="text-xs text-red-600 font-bold">Gagal</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('patient.appointments.show', $appointment) }}" class="text-gray-400 hover:text-primary transition-colors" title="Detail">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                    </a>
                                                    
                                                    @if($appointment->payment_status === 'pending' && !$appointment->isPaymentExpired())
                                                        <a href="{{ route('patient.payments.show', $appointment) }}" class="inline-flex items-center px-3 py-1 bg-primary text-white hover:bg-primary-dark rounded-md transition-colors text-xs font-bold uppercase tracking-wide shadow-sm">
                                                            Bayar
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <!-- Custom Empty State -->
                        <div class="text-center py-12 text-gray-500 flex flex-col items-center justify-center">
                            <div class="h-24 w-24 bg-primary-light/20 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-12 w-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Belum Ada Janji Temu</h3>
                            <p class="text-gray-500 mt-1 max-w-sm text-center">Anda belum memiliki jadwal konsultasi. Silakan buat janji temu dengan dokter kami.</p>
                            <div class="mt-6">
                                <a href="{{ route('patient.appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-primary border border-transparent rounded-lg font-bold text-sm text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-md">
                                    + Buat Janji Baru
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
