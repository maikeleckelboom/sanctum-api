<?php

namespace Database\Seeders;

use Database\Factories\OrganizationFactory;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationFactory::new()->times(10)->create();
    }
}
