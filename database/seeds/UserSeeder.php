<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')
            ->updateOrInsert(
                ['email' => 'test@test.com'],
                ['password' =>  bcrypt('test@test.com'), 'name' => 'John']
            );
        factory(App\User::class, 50)->create();
    }
}
