<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Medical Record Details') }}
            </h2>
            <!-- Print Button -->
            <div class="flex space-x-2 no-print">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </button>
                
                <a href="{{ route('medical-records.print-prescription', $medicalRecord->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Cetak Resep
                </a>

                @if(auth()->user()->hasRole('doctor') && $medicalRecord->appointment->doctor_id === auth()->user()->doctor->id)
                    <a href="{{ route('medical-records.edit', $medicalRecord->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit Record
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 printable-container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg printable-card">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header for Print Only -->
                    <div class="hidden print-header mb-8 border-b pb-4">
                        <h1 class="text-2xl font-bold text-primary">HealthCare.</h1>
                        <p class="text-sm text-gray-500">Laporan Rekam Medis Pasien</p>
                        <p class="text-xs text-gray-400 mt-1">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Informasi Kunjungan</h3>
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $medicalRecord->visit_date->format('d M Y') }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Dokter</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $medicalRecord->appointment->doctor->user->name }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Pasien</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $medicalRecord->appointment->patient->user->name }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Keluhan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $medicalRecord->appointment->complaint }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Detail Medis</h3>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Diagnosis</h4>
                                <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded print:bg-transparent print:p-0 print:border print:border-gray-200">{{ $medicalRecord->diagnosis }}</p>
                            </div>
                            
                            @if($medicalRecord->doctor_notes)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Catatan Dokter</h4>
                                <p class="mt-1 text-sm text-gray-900 bg-gray-50 p-3 rounded whitespace-pre-line print:bg-transparent print:p-0 print:border print:border-gray-200">{{ $medicalRecord->doctor_notes }}</p>
                            </div>
                            @endif

                            @if($medicalRecord->attachment_path)
                            <div class="mb-4 no-print">
                                <h4 class="text-sm font-medium text-gray-500">Hasil Pemeriksaan</h4>
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $medicalRecord->attachment_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                                        Lihat Lampiran
                                    </a>
                                </div>
                            </div>
                            @endif

                            @if($medicalRecord->prescriptions->count() > 0)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Resep Obat</h4>
                                <div class="bg-gray-50 rounded-lg overflow-hidden border print:bg-transparent print:border-gray-300">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100 print:bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Obat</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dosis</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aturan Pakai</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($medicalRecord->prescriptions as $prescription)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $prescription->medication }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $prescription->dosage }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $prescription->instructions }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end no-print">
                        <a href="{{ route('medical-records.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-container, .printable-container * {
                visibility: visible;
            }
            .printable-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            .printable-card {
                box-shadow: none !important;
                border: none !important;
            }
            .no-print {
                display: none !important;
            }
            .print-header {
                display: block !important;
            }
            /* Hide the default Layout Navigation */
            nav, header {
                display: none !important;
            }
        }
    </style>
</x-app-layout>
