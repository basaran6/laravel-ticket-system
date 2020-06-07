<?php

use App\TicketPriority;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketPriority::updateOrCreate(
            ['id' => 1],
            ['title' => 'Düşük']
        );
        TicketPriority::updateOrCreate(
            ['id' => 2],
            ['title' => 'Normal']
        );
        TicketPriority::updateOrCreate(
            ['id' => 3],
            ['title' => 'Yüksek']
        );
    }
}
