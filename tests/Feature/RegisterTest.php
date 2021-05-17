<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_register()
    {
        $data = $this->get_sample_data();

        $this->postJson('api/v1/register', $data)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }

    /**
     * Validation Test
     *
     * @return void
     */
    public function test_register_validation()
    {
        $data = $this->get_sample_data();

        unset($data['name']);

        $this->postJson('api/v1/register', $data)
            ->assertStatus(422)
            ->assertJson(array (
                'message' => 'The given data was invalid.',
                'errors' =>
                array (
                  'name' =>
                  array (
                    0 => 'The name field is required.',
                  )
                )
              ));
    }

    protected function get_sample_data()
    {
        return array (
            'name'      => $this->faker->name,
            'address1'  => $this->faker->address,
            'address2'  => $this->faker->address,
            'city'      => $this->faker->city,
            'state'     => $this->faker->state,
            'country'   => $this->faker->country,
            'zipCode'   => $this->faker->postcode,
            'phoneNo1'  => $this->faker->phoneNumber,
            'phoneNo2'  => $this->faker->phoneNumber,
            'user'      =>
            array (
              'firstName'   =>  $this->faker->firstName,
              'lastName'    =>  $this->faker->lastName,
              'email'       =>  $this->faker->email,
              'password'    => 'abc123',
              'passwordConfirmation' => 'abc123',
              'phone'       =>  $this->faker->phoneNumber,
            ),
        );
    }
}
