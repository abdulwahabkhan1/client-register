<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AccountsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_get_accounts()
    {
        Client::factory()
            ->has(User::factory()->count(3), 'users')
            ->create();

        $this->getJson('api/v1/accounts')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'  =>  [
                    '*'   =>  [
                        'id',
                        'name',
                        'address1'
                    ]
                ],
                'links' =>  [],
                'meta'  =>  []
            ]);
    }
}
