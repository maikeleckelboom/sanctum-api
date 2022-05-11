<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Reference to .env file
         */
        $debug = config('app.debug', false);
        $demo = config('app.demo', false);

        /**
         * Call seeders
         */
        $this->call([
            UserSeeder::class,
        ], false, ['debugOrDemo' => $debug || $demo]);
    }
}
