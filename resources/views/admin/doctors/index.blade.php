<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Daftar Dokter') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data dokter, jadwal praktik, dan biaya konsultasi.</p>
            </div>
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
            <!-- Toast global -->

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    
                    <!-- Toolbar -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h3 class="text-lg font-bold text-gray-800">Semua Dokter</h3>
                        
                        <!-- Search Bar -->
                        <div class="relative w-full md:w-64">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input x-model="search" type="text" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition duration-150 ease-in-out" placeholder="Cari dokter...">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th @click="sortTable(0)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                        <div class="flex items-center">
                                            Nama Dokter
                                            <svg :class="{'rotate-180': sortCol === 0 && !sortAsc, 'text-primary': sortCol === 0}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </th>
                                    <th @click="sortTable(1)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                         <div class="flex items-center">
                                            Username
                                            <svg :class="{'rotate-180': sortCol === 1 && !sortAsc, 'text-primary': sortCol === 1}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                                    <th @click="sortTable(3)" scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition user-select-none group">
                                         <div class="flex items-center">
                                            Biaya Jasa
                                            <svg :class="{'rotate-180': sortCol === 3 && !sortAsc, 'text-primary': sortCol === 3}" class="w-4 h-4 ml-1 text-gray-400 transition-transform group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            
                            <!-- Skeleton Loader -->
                            <tbody class="bg-white divide-y divide-gray-200" x-show="!loaded">
                                @for ($i = 0; $i < 5; $i++)
                                <tr class="animate-pulse">
                                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-1/2"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-1/2"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-1/4"></div></td>
                                    <td class="px-6 py-4"><div class="h-4 bg-gray-200 rounded w-full"></div></td>
                                </tr>
                                @endfor
                            </tbody>

                            <tbody class="bg-white divide-y divide-gray-200" x-show="loaded" x-ref="tableBody" style="display: none;">
                                @forelse($doctors as $doctor)
                                <tr class="hover:bg-gray-50 transition-colors duration-200" x-show="!search || $el.innerText.toLowerCase().includes(search.toLowerCase())" x-transition>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-primary-light flex items-center justify-center text-primary font-bold text-lg">
                                                    {{ strtoupper(substr($doctor->user->name ?? $doctor->username, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name ?? $doctor->username }}</div>
                                                <div class="text-xs text-gray-500">ID: #{{ $doctor->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $doctor->username }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $doctor->user->email ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $doctor->fee ? 'Rp '.number_format($doctor->fee,0,',','.') : 'Belum set' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('doctors.sessions.index', $doctor) }}" class="inline-flex items-center px-3 py-1 bg-primary-light text-primary-dark hover:bg-primary hover:text-white rounded-md transition-colors text-xs font-bold uppercase tracking-wide">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Jadwal
                                            </a>
                                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-md transition-colors text-xs font-bold uppercase tracking-wide">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Biaya
                                            </a>
                                            <!-- Optional Delete: Using Global Modal if route exists, keeping consistency -->
                                            <!-- Assuming route exists like admin.doctors.destroy or similar. If not, hidden.
                                                 Based on previous context, user list has delete. Doctor list often is managed via user. 
                                                 I will NOT add a delete button if unsure about the route, to avoid 404s. 
                                                 "Kelola data dokter" was the header. 
                                                 I will stick to the existing actions but with the new Empty State. -->
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <!-- Custom Empty State: Doctors -->
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="h-24 w-24 bg-primary-light/30 rounded-full flex items-center justify-center mb-4">
                                                 <!-- Stethoscope SVG -->
                                                <svg class="h-12 w-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900">Belum Ada Dokter</h3>
                                            <p class="text-gray-500 mt-1 max-w-sm text-center">Data dokter tidak ditemukan. Silakan tambahkan dokter baru melalui menu Pengguna.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $doctors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
