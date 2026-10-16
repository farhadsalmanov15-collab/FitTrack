
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    public function index() {
        $user = Auth::user();

        $totalSessions = $user->workoutSessions()->count();

        $sessionsThisMonth = $user->workoutSessions()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        $lastSession = $user->workoutSessions()
            ->orderBy('date', 'desc')
            ->first();

        $recentSessions = $user->workoutSessions()
            ->with('workoutSets.exercise')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        // Calculate streak
        $streak = 0;
        $sessions = $user->workoutSessions()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->toDateString())
            ->unique()
            ->values();

        $check = now()->toDateString();
        foreach ($sessions as $date) {
            if ($date === $check) {
                $streak++;
                $check = now()->subDays($streak)->toDateString();
            } else {
                break;
            }
        }

        return view('dashboard', compact(
            'totalSessions',
            'sessionsThisMonth',
            'lastSession',
            'recentSessions',
            'streak'
        ));
    }
}