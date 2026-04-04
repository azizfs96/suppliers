<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $agentsCount = Agent::query()->where('user_id', auth()->id())->count();

        $brandsCount = Agent::query()
            ->where('user_id', auth()->id())
            ->select(['id', 'brands'])
            ->get()
            ->sum(fn (Agent $agent): int => is_array($agent->brands) ? count($agent->brands) : 0);

        $skuCount = 0;

        return view('dashboard', compact('agentsCount', 'brandsCount', 'skuCount'));
    }
}
