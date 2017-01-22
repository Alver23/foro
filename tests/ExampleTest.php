<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Alver Grisales',
            'email' => 'viga.23@hotmail.com'
        ]);
        $this->actingAs($user, 'api')
            ->visit('/api/user')
            ->see('Alver Grisales')
            ->see('viga.23@hotmail.com');
    }
}
