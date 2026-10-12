<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get appointments for the last 7 days
        $appointments = Appointment::select(
            DB::raw('DATE(date) as date'),
            DB::raw('count(*) as count')
        )
        ->where('date', '>=', now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Prepare data for Chart.js
        $labels = [];
        $data = [];
        
        // Fill in missing days with 0
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $record = $appointments->firstWhere('date', $date);
            
            $labels[] = now()->subDays($i)->isoFormat('dddd'); // Day name (Senin, Selasa...)
            $data[] = $record ? $record->count : 0;
        }

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
