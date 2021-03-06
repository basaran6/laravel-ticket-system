<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteTicketRequest;
use App\Ticket;
use Illuminate\Http\Request;
use Response;

class CompleteTicketController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\CompleteTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompleteTicketRequest $request)
    {
        $ticket = Ticket::find($request->id);
        $ticket->ticket_status_id = Ticket::STATUS_COMPLETED;
        $ticket->save();
        return response()->json('Ticket başarıyla tamamlandı!');
    }
}
