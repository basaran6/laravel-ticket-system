<?php

use App\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketType::updateOrCreate(
            ['id'   =>  1],
            ['title' =>  'Genel']
        );
        TicketType::updateOrCreate(
            ['id'   =>  2],
            ['title' =>  'Ticket Sistemi']
        );
    }
}
