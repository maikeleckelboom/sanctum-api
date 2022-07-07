<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\AddressFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::all()->count() > 0)
            return;

        $administrator = UserFactory::new([
            'name' => config('seeding.name', 'Maikel Eckelboom'),
            'password' => Hash::make(config('seeding.password', 'Pa$$word!')),
            'email' => config('seeding.email', 'admin@account.com'),
        ])->create();

        AddressFactory::new()->create([
            'addressable_type' => User::class,
            'addressable_id' => 1,
        ]);

        $users = UserFactory::new()->times(10)->create();

        foreach ($users as $user) {
            $user->address()->save(AddressFactory::new()->create([
                'addressable_type' => User::class,
                'addressable_id' => $user->id,
            ]));
        }
    }
}
