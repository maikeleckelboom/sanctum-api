<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'postcode' => $this->faker->postcode,
            'street_name' => $this->faker->streetName,
            'building_number' => $this->faker->buildingNumber,
            'province' => $this->faker->state,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'address_type' => $this->faker->randomElement(['home', 'work', 'installation']),
        ];
    }
}
