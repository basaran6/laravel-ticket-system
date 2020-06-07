<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    const CACHE_TTL = 100;
    const STATUS_OPENED = 1;
    const STATUS_COMPLETED = 2;

    /**
     * Default values for attributes
     * @var  array an array with attribute as key and default as value
     */
    protected $attributes = [
        'ticket_status_id' => self::STATUS_OPENED
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'ticket_type_id', 'ticket_priority_id'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['comments', 'agent:id,name', 'customer:id,name', 'ticketType:id,title', 'ticketPriority:id,title'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->customer_id = Auth::user()->id;
        });
    }

    // Mutators
    /**
     * Get the ticket's days active.
     *
     * @return string
     */
    public function getDaysActiveAttribute()
    {
        $now = Carbon::now();
        if($this->completed_at){
            return $this->created_at->diff($this->completed_at)->days . ' gün aktifti! (Ticket Kapalı)';
        }
        return $this->created_at->diff($now)->days . ' gündür aktif!';
    }

    // Relations
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
