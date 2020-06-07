<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTicketRequest;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Response;

class AssignTicketController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\AssignTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AssignTicketRequest $request)
    {
        $ticket = Ticket::find($request->id);
        $ticket->agent_id = Auth::user()->id;
        $ticket->save();
        return response()->json(['status' => 'Başarıyla ticket üzerine atandı!']);
    }
}
