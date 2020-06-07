<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Ticket;
use App\TicketPriority;
use App\TicketStatus;
use App\TicketType;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;


$factory->define(App\Ticket::class, function (Faker $faker) {
    $ticketStatusID =  TicketStatus::all()->random()->id;
    $createdAt = Carbon::now()->subDays(rand(0, 10));
    $completedAt = null;
    if ($ticketStatusID == Ticket::STATUS_COMPLETED) {
        $completedAt = $createdAt->addMinutes(rand(10, 1000));
    }
    return [
        'title' => $faker->sentence(5),
        'body'  =>  $faker->paragraph,
        'ticket_type_id'    =>  TicketType::all()->random()->id,
        'ticket_status_id'  =>  $ticketStatusID,
        'ticket_priority_id'    =>  TicketPriority::all()->random()->id,
        'agent_id'  =>  User::all()->random()->id,
        'customer_id'   =>  User::all()->random()->id,
        'created_at'    =>  $createdAt,
        'completed_at'  =>  $completedAt
    ];
});
