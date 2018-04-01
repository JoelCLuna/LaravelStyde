<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsers extends TestCase
{
    /** @test */

    function it_welcome_user_with_nickname()
    {
        $this->get('/saludo/Joel/Buffalo')
            ->assertStatus(200)
            ->assertSee('bienvenido Joel tu apodo es Buffalo');
    }

    /** @test */
    function it_welcome_user_without_nickname()
    {
        $this->get('/saludo/Joel')
            ->assertStatus(200)
            ->assertSee('bienvenido Joel');

    }
}
