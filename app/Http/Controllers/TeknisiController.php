<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Perbaikan::query();
        $queryplg = Pelanggan::query();
    
        // Filtering
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    
        // Pencarian
        if ($request->filled('search')) {
            $query->where('id_plg', 'like', '%' . $request->search . '%')
                ->orWhere('nama_plg', 'like', '%' . $request->search . '%');
        }
    
        // Sorting
        $sort = $request->get('sort', 'asc');
        $query->orderBy('created_at', $sort);
    
        $perbaikan = $query->get();
        
        // Mengambil semua id_plg dari tabel pelanggan
        $data = $queryplg->pluck('id_plg');
    
        // Data for charts
        $weeklyData = $query->selectRaw('WEEK(created_at) as week, COUNT(*) as total')
            ->groupBy('week')
            ->pluck('total', 'week');
    
        $monthlyData = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
    
        $yearlyData = $query->selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->pluck('total', 'year');
    
        return view('teknisi.index', compact('perbaikan', 'data', 'sort', 'weeklyData', 'monthlyData', 'yearlyData'));
    }

    function coba () {
        return view('coba');
    }
}
