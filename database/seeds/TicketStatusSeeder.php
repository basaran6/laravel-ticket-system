<?php

use App\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketStatus::updateOrCreate(
            ['id' => 1],
            ['title' =>  'Açık']
        );
        TicketStatus::updateOrCreate(
            ['id' => 2],
            ['title' =>  'Kapalı']
        );
    }
}
