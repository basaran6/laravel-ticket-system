<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Cache::remember('dashboard', 5, function () {
            $latestTickets = Ticket::orderBy('id', 'desc')->take(10)->get();
            $activeAndHighPriorityTickets = Ticket::active()->highPriority()->orderBy('id', 'desc')->take(10)->get();
            $activeTicketsOlderThan7Days = Ticket::active()->olderThanDays(7)->orderBy('id', 'asc')->take(10)->get();
            $tables = array(
                'Latest Tickets'    =>  $latestTickets,
                'Active and high priority tickets'  =>  $activeAndHighPriorityTickets,
                'Active Tickets Older Than 7 Days'  =>  $activeTicketsOlderThan7Days
            );
            return view('home', compact(['tables']))->render();
        });
    }
}
