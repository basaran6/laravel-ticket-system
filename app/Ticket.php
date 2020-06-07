<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['comments', 'agent:id,name', 'customer:id,name', 'ticketType:id,title', 'ticketPriority:id,title'];

    /**
     * Get the agent for the ticket.
     */
    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id', 'id');
    }

    /**
     * Get the comments for the ticket.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the ticket priority for the ticket.
     */
    public function ticketPriority()
    {
        return $this->belongsTo('App\TicketPriority');
    }

    /**
     * Get the ticket status for the ticket.
     */
    public function ticketStatus()
    {
        return $this->belongsTo('App\TicketStatus');
    }

    /**
     * Get the ticket type for the ticket.
     */
    public function ticketType()
    {
        return $this->belongsTo('App\TicketType');
    }

    /**
     * Get the customer for the ticket.
     */
    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id', 'id');
    }
}
