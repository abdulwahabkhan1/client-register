<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'    =>  $this->faker->firstName,
            'last_name'     =>  $this->faker->lastName,
            'email'         =>  $this->faker->unique()->safeEmail(),
            'password'      => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'         =>  $this->faker->phoneNumber,
            'profile_uri'   =>  $this->faker->text,
            'last_password_reset'   =>  now()->format("Y-m--d H:i:s"),
            'status'        =>  $this->faker->randomElement(['Active', 'Inactive'])
        ];
    }

}
