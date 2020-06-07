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
    public function index(Request $request)
    {
        $currentPage = request()->get('page', 1);
        $type = request()->get('type', null);
        $perPage = 10; // User özelinde yapılabilir.
        return Cache::remember('tickets-' . $type . '-pp-' . $perPage . '-p-' . $currentPage, Ticket::CACHE_TTL, function () use ($type, $perPage, $currentPage) {
            if ($type == 'active') {
                $tickets = Ticket::active()->orderBy('id', 'desc')->paginate($perPage,  ['*'], 'page', $currentPage);
            } else if ($type == 'completed') {
                $tickets = Ticket::completed()->orderBy('id', 'desc')->paginate($perPage,  ['*'], 'page', $currentPage);
            } else {
                $tickets = Ticket::orderBy('id', 'desc')->paginate($perPage,  ['*'], 'page', $currentPage);
            }
            $tickets->appends(request()->query());
            return view('tickets.index', compact('tickets'))->render();
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Cache::remember('create-ticket', Ticket::CACHE_TTL, function () {
            $ticketTypes = Cache::remember('ticket_types', Ticket::CACHE_TTL, function () {
                return DB::table('ticket_types')->select('id', 'title')->get();
            });

            $ticketPriorities = Cache::remember('ticket_priorities', Ticket::CACHE_TTL, function () {
                return DB::table('ticket_priorities')->select('id', 'title')->get();
            });

            return view('tickets.form', compact([
                'ticketTypes',
                'ticketPriorities'
            ]))->render();
        });
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
        return redirect()->route('tickets.show', ['ticket' => $ticket])->with('status', 'Ticket created!');
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
