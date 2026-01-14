<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Poll\PollStatus;
use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $recentPolls = Poll::with('owner')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($poll) => [
                'id' => $poll->id,
                'description' => "Poll '{$poll->name}' was created.",
                'time' => $poll->created_at->toDateTimeString(),
                'type' => 'poll',
            ]);

        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(fn($user) => [
                'id' => $user->id,
                'description' => "User {$user->name} registered.",
                'time' => $user->created_at->toDateTimeString(),
                'type' => 'user',
            ]);

        return Inertia::render('Dashboard/Index', [
            'recentPolls' => Poll::latest()->take(4)->get(),
            'stats' => [
                'activePolls' => Poll::where('status', PollStatus::ACTIVE)->count(),
                'newUsers' => User::where('created_at', '>=', now()->subWeek())->count(),
            ],
            'activity' => $this->recentActivity($recentPolls, $recentUsers)
        ]);
    }

    private function recentActivity(Collection $recentPolls, Collection $recentUsers): Collection
    {
        return $recentPolls
            ->merge($recentUsers)
            ->sortByDesc('time')
            ->take(10)
            ->values();
    }
}
