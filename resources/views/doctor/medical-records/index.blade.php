<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Rekam Medis') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola riwayat kesehatan dan diagnosis pasien.</p>
            </div>
            <a href="{{ route('doctor.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150 mt-4 md:mt-0">
                ← Kembali
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
                        <h3 class="text-lg font-bold text-gray-800">Daftar Rekam Medis ({{ $medicalRecords->count() }})</h3>
                        
                        <!-- Search Bar -->
                        <div class="relative w-full md:w-64">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input x-model="search" type="text" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-150 ease-in-out" placeholder="Cari pasien / diagnosis...">
                        </div>
                    </div>

                    @if($medicalRecords->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <!-- Sortable Header 0: Tanggal -->
                                        <th @click="sortTable(0)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Tanggal
                                                <svg :class="{'rotate-180': sortCol === 0 && !sortAsc, 'text-primary': sortCol === 0}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <!-- Sortable Header 1: Pasien -->
                                        <th @click="sortTable(1)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Pasien
                                                <svg :class="{'rotate-180': sortCol === 1 && !sortAsc, 'text-primary': sortCol === 1}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <!-- Sortable Header 2: Diagnosis -->
                                        <th @click="sortTable(2)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                            <div class="flex items-center">
                                                Diagnosis
                                                <svg :class="{'rotate-180': sortCol === 2 && !sortAsc, 'text-primary': sortCol === 2}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Keluhan</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                
                                <!-- Skeleton Loader -->
                                <tbody class="bg-white divide-y divide-gray-200" x-show="!loaded">
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr class="animate-pulse">
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-24"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-40"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-32"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-48"></div></td>
                                        <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-full"></div></td>
                                    </tr>
                                    @endfor
                                </tbody>

                                <tbody class="bg-white divide-y divide-gray-200" x-show="loaded" x-ref="tableBody" style="display: none;">
                                    @foreach($medicalRecords as $record)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200" x-show="!search || $el.innerText.toLowerCase().includes(search.toLowerCase())" x-transition>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $record->visit_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-primary-light flex items-center justify-center text-primary font-bold text-xs">
                                                        {{ strtoupper(substr($record->appointment->patient->user->name ?? '?', 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $record->appointment->patient->user->name ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $record->diagnosis ?? 'Belum ada' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                            {{ $record->appointment->complaint ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('medical-records.show', $record->id) }}" class="text-primary hover:text-primary-dark font-semibold hover:underline flex items-center justify-end">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $medicalRecords->links() }}
                        </div>
                    @else
                        <!-- Custom Empty State: Medical Records -->
                        <div class="text-center py-12 text-gray-500 flex flex-col items-center justify-center">
                             <div class="h-24 w-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <p class="text-lg font-bold text-gray-900">Belum Ada Rekam Medis</p>
                            <p class="text-sm">Riwayat kesehatan pasien akan muncul di sini setelah pemeriksaan selesai.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
