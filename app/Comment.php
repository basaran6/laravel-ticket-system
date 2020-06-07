<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'ticket_id'];
    
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['author:id,name'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->author_id = Auth::user()->id;
        });
    }
    /**
     * Get the author for the comment.
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
