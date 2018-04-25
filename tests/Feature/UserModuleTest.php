<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{

    use RefreshDatabase;
    /** @test**/
    function it_shows_the_users_list()
    {

        factory(User::class)->create([
            'name' => 'Joel',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie'
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }
    /**@test**/
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }
    /**@test**/
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            "name" => "Joel Celaya"
        ]);

        $this->get("/usuarios/{$user->id}")
            ->assertStatus(200)
            ->assertSee('Joel Celaya');
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }


    /**@test**/
    function itLoads_the_new_Users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

    /**@test**/
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'Joe',
            'email' => 'joel@buffalo.mx',
            'password' => '123456'
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'Joe',
            'email' => 'joel@buffalo.mx',
            'password' => '123456'
        ]);

    }

    /** @test */
    function the_name_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'joel@buffalo.mx',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        $this->assertEquals(0, User::count());
//        $this->assertDatabaseMissing('users', [
//            'email' => 'joel@buffalo.mx',
//        ]);
    }

    /** @test**/
    function the_email_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Joel',
                'email' => '',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test**/
    function the_email_must_be_valid()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Joel',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }

    /** @test**/
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'joel@buffalo.mx'
        ]);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Joel',
                'email' => 'joel@buffalo.mx',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Joel',
                'email' => 'joel@buffalo.mx',
                'password' => ''
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /**@test**/
    function itLoads_the_edit_user_page()
    {
        $user =factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function ($viewUser) use ($user){
                return $viewUser->id === $user->id;
            });
    }
    /**@test**/
    function it_update_a_user()
    {
        $user =factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Joe',
            'email' => 'joel@buffalo.mx',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Joe',
            'email' => 'joel@buffalo.mx',
            'password' => '123456'
        ]);

    }

    /** @test */
    function the_name_is_required_when_updating_the_user()
    {
        $user =factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
             ->put("/usuarios/{$user->id}", [
                'name' => '',
                'email' => 'joel@buffalo.mx',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);
    }

    /** @test**/
    function the_email_must_be_valid_when_updating_the_users()
    {
        $user =factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->post("/usuarios/{$user->id}", [
                'name' => 'Joel Celaya',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['name'=>'Joel Celaya']);
    }

    /** @test**/
    function the_email_must_be_unique_when_updating_the_users()
    {
        factory(User::class)->create([
            'email' => 'existing-email@example.com',
        ]);

        $user = factory(User::class)->create([
            'email' => 'joel@buffalo.mx'
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Joel',
                'email' => 'existing-email@example.com',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function the_users_email_can_stay_the_same_when_updating_the_user()
    {
        $user = factory(User::class)->create([
            'email' => 'joel@buffalo.mx'
        ]);
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Joel Celaya',
                'email' => 'joel@buffalo.mx',
                'password' => '12345678'
            ])
            ->assertRedirect("usuarios/{$user->id}"); // (users.show)
        $this->assertDatabaseHas('users', [
            'name' => 'Joel Celaya',
            'email' => 'joel@buffalo.mx',
        ]);
    }

    /** @test */
    function the_password_is_optional_when_updating_the_users()
    {
        $oldPasswd = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password'=> bcrypt($oldPasswd)
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Joel',
                'email' => 'joel@buffalo.mx',
                'password' => ''
            ])
            ->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Joel',
            'email'=>'joel@buffalo.mx',
            'password' => $oldPasswd
        ]);
    }

}

