<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 3 random doctors with their user profile
        $doctors = \App\Models\Doctor::with('user')->inRandomOrder()->limit(3)->get();
        
        // Define Services (Static for now as we don't have a model)
        $services = [
            ['title' => 'Masalah Pencernaan', 'desc' => 'Diagnosis akurat dan perawatan efektif untuk berbagai gangguan pencernaan dan lambung.', 'icon' => 'M5 13l4 4L19 7'],
            ['title' => 'Perawatan Anak', 'desc' => 'Layanan kesehatan komprehensif untuk tumbuh kembang anak dengan dokter spesialis anak.', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
            ['title' => 'Kesehatan Hormonal', 'desc' => 'Terapi dan konsultasi untuk menjaga keseimbangan hormon demi kesehatan tubuh yang optimal.', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
            ['title' => 'Autoimun & Inflamasi', 'desc' => 'Penanganan medis terkini untuk mengelola kondisi autoimun dan peradangan kronis.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
            ['title' => 'Kesehatan Mental', 'desc' => 'Dukungan profesional untuk kesehatan mental, manajemen stres, dan kesejahteraan psikologis.', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ['title' => 'Kesehatan Jantung', 'desc' => 'Pemeriksaan rutin dan perawatan jantung untuk mencegah penyakit kardiovaskular.', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z']
        ];

        return view('landing', compact('doctors', 'services'));
    }
}
