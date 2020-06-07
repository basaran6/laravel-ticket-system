<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\TicketPriority;
use App\TicketStatus;
use App\TicketType;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'body'  =>  $faker->paragraph,
        'ticket_type_id'    =>  TicketType::all()->random()->id,
        'ticket_status_id'  =>  TicketStatus::all()->random()->id,
        'ticket_priority_id'    =>  TicketPriority::all()->random()->id,
        'agent_id'  =>  User::all()->random()->id,
        'customer_id'   =>  User::all()->random()->id,
    ];
});
