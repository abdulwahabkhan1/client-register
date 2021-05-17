<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name'   =>  $this->faker->name(),
            'address1'      =>  $this->faker->address,
            'address2'      =>  $this->faker->address,
            'city'          =>  $this->faker->city,
            'state'         =>  $this->faker->state,
            'country'       =>  $this->faker->country,
            'zip'           =>  $this->faker->postcode,
            'latitude'      =>  $this->faker->latitude,
            'longitude'     =>  $this->faker->longitude,
            'phone_no1'      =>  $this->faker->phoneNumber,
            'phone_no2'      =>  $this->faker->phoneNumber,
            'start_validity'    =>  now()->format("Y-m-d"),
            'end_validity'  =>  now()->format("Y-m-d"),
            'status'        =>  $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
