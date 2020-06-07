<?php

namespace App\Observers;

use App\Ticket;
use Illuminate\Support\Facades\Cache;

class TicketObserver
{
    /**
     * Handle the ticket "created" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        //
    }

    /**
     * Listen to the ticket "updating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(Ticket $ticket)
    {
        if ($ticket->ticket_status_id != $ticket->getOriginal('ticket_status_id') && $ticket->ticket_status_id == Ticket::STATUS_COMPLETED) {
            $ticket->completed_at = now();
        }
    }
    
    /**
     * Handle the ticket "updated" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        Cache::forget('show-ticket' . $ticket->id);
        Cache::tags(['list-tickets'])->flush();
    }

    /**
     * Handle the ticket "saved" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function saved(Ticket $ticket)
    {
        Cache::forget('show-ticket' . $ticket->id);
        Cache::tags(['list-tickets'])->flush();
    }

    /**
     * Handle the ticket "deleted" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "restored" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the ticket "force deleted" event.
     *
     * @param  \App\Ticket  $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        //
    }
}
