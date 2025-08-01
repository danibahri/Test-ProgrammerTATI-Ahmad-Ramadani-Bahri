<?php

namespace App\Http\Controllers;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::with('dailyLogs', 'subordinates')->find(Auth::id());

        $logSummary = $user->dailyLogs()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")
            ->selectRaw("SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) as approved")
            ->selectRaw("SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected")
            ->first();

        $myStats = [
            'total_logs' => $logSummary->total,
            'pending_logs' => $logSummary->pending,
            'approved_logs' => $logSummary->approved,
            'rejected_logs' => $logSummary->rejected,
        ];

        $subordinates = $user->subordinates;
        $subordinateStats = null;
        $recentSubordinateLogs = null;

        if ($subordinates->isNotEmpty()) {
            $subordinateIds = $subordinates->pluck('id');

            $subordinateStats = [
                'total_subordinates' => $subordinates->count(),
                'pending_verification' => DailyLog::whereIn('user_id', $subordinateIds)
                    ->where('status', 'pending')->count(),
                'total_subordinate_logs' => DailyLog::whereIn('user_id', $subordinateIds)->count(),
            ];

            $recentSubordinateLogs = DailyLog::with('user')
                ->whereIn('user_id', $subordinateIds)
                ->where('status', 'pending')
                ->orderBy('log_date', 'desc')
                ->take(5)
                ->get();
        }

        $recentLogs = $user->dailyLogs()
            ->orderBy('log_date', 'desc')
            ->take(5)
            ->get();

        // Monthly Chart Data
        $monthlyData = $user->dailyLogs()
            ->select(
                DB::raw('MONTH(log_date) as month'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved'),
                DB::raw('SUM(CASE WHEN status = "rejected" THEN 1 ELSE 0 END) as rejected'),
                DB::raw('SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
            )
            ->whereYear('log_date', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('pages.dashboard', compact(
            'user',
            'myStats',
            'subordinateStats',
            'recentLogs',
            'recentSubordinateLogs',
            'monthlyData'
        ));
    }
}
