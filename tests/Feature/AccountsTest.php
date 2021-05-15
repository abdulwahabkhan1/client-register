<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AccountsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_get_accounts()
    {
        $this->getJson('api/v1/accounts')
        ->assertStatus(200);
    }
}
