<?php

use Illuminate\Database\Seeder;

class TodoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Todo::class, 50)->create();
    }
}
