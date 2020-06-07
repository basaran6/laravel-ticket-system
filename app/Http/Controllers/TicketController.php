<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index')->with([
            'tickets'   =>  $tickets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticketTypes = Cache::remember('ticket_types', Ticket::CACHE_TTL, function () {
            return DB::table('ticket_types')->select('id', 'title')->get();
        });

        $ticketPriorities = Cache::remember('ticket_priorities', Ticket::CACHE_TTL, function () {
            return DB::table('ticket_priorities')->select('id', 'title')->get();
        });

        return view('tickets.form')->with([
            'ticketTypes'  =>  $ticketTypes,
            'ticketPriorities'  =>  $ticketPriorities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->validated());
        return redirect()->route('tickets.show', ['ticket' => $ticket])->with('status', 'Profile updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cache::remember('show-ticket' . $id, Ticket::CACHE_TTL, function () use ($id) {
            $ticket = Ticket::findOrFail($id);
            return view('tickets.view', compact('ticket'))->render();
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
