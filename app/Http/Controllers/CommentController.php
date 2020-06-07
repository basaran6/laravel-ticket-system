<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        return redirect()->route('tickets.show', ['ticket' => $comment->ticket_id])->with('status', 'Yorum Yapıldı!');
    }
}
