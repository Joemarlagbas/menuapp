<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers     = User::count();
        $totalMenuItems = MenuItem::count();
        $myMenuItems    = MenuItem::where('user_id', Auth::id())->count();

        // Users registered per month (last 6 months)
        $usersByMonth = User::selectRaw("
                DATE_FORMAT(created_at, '%Y-%m') as month_key,
                COUNT(*) as count
            ")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month_key')
            ->orderBy('month_key', 'asc')
            ->get()
            ->map(function ($item) {
                $item->month = Carbon::createFromFormat('Y-m', $item->month_key)
                    ->format('M Y');
                return $item;
            });

        // Menu items by category
        $itemsByCategory = MenuItem::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        // Available vs unavailable
        $availableCount   = MenuItem::where('available', 1)->count();
        $unavailableCount = MenuItem::where('available', 0)->count();

        return view('dashboard.index', compact(
            'totalUsers',
            'totalMenuItems',
            'myMenuItems',
            'usersByMonth',
            'itemsByCategory',
            'availableCount',
            'unavailableCount'
        ));
    }
}   