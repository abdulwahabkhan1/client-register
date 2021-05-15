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
        $data = array (
            'name' => 'saad',
            'address1' => 'test',
            'address2' => 'test2',
            'city' => 'lhe',
            'state' => 'kp',
            'country' => 'pk',
            'zipCode' => '3233',
            'phoneNo1' => '2323423423',
            'phoneNo2' => '',
            'user' =>
            array (
              'firstName' => 'abdul',
              'lastName' => 'khan',
              'email' => 'khan@mail.com',
              'password' => 'abc123',
              'passwordConfirmation' => 'abc123',
              'phone' => '3232323',
            ),
        );

        $this->postJson('api/v1/register', $data)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);
    }
}
