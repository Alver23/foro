<?php

class ExampleTest extends FeatureTestCase
{

    function test_basic_example()
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
