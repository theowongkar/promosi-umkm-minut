<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;

class DashboardController extends Controller
{
    public function index()
    {
        $usersData = $this->getUsersData();
        $businessesData = $this->getBusinessesData();

        return view('dashboard.index', array_merge($usersData, $businessesData));
    }

    private function getUsersData()
    {
        // Ambil User
        $users = User::all();

        // Statistik umum
        $totalActiveUsers = $users->where('status', 'Aktif')->count();
        $totalActiveAdmins = $users->where('status', 'Aktif')->where('role', 'Admin')->count();
        $totalActiveSellers = $users->where('status', 'Aktif')->where('role', 'Penjual')->count();
        $totalActiveVisitors = $users->where('status', 'Aktif')->where('role', 'Pengunjung')->count();

        // Line Chart Data
        $months = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->translatedFormat('M'));

        $activeUsersByMonth = collect(range(1, 12))->map(
            fn($month) =>
            User::where('status', 'Aktif')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count()
        );

        $inactiveUsersByMonth = collect(range(1, 12))->map(
            fn($month) =>
            User::where('status', '!=', 'Aktif')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count()
        );

        return [
            'totalActiveUsers' => $totalActiveUsers,
            'totalActiveAdmins' => $totalActiveAdmins,
            'totalActiveSellers' => $totalActiveSellers,
            'totalActiveVisitors' => $totalActiveVisitors,
            'months' => $months,
            'activeUsersByMonth' => $activeUsersByMonth,
            'inactiveUsersByMonth' => $inactiveUsersByMonth,
        ];
    }

    private function getBusinessesData()
    {
        // Ambil Usaha
        $totalBusinesses = Business::count();

        // Statistik umum
        $totalMicroBusinesses = Business::where('business_type', 'Mikro')->count();
        $totalSmallBusinesses = Business::where('business_type', 'Kecil')->count();
        $totalMediumBusinesses = Business::where('business_type', 'Menengah')->count();

        // Line Chart Data
        $months = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->translatedFormat('M'));

        $businessesByMonth = collect(range(1, 12))->map(
            fn($month) =>
            Business::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count()
        );

        return compact(
            'totalBusinesses',
            'totalMicroBusinesses',
            'totalSmallBusinesses',
            'totalMediumBusinesses',
            'months',
            'businessesByMonth'
        );
    }
}
