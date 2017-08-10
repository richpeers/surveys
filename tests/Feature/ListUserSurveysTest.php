<?php

namespace Tests\Feature;

use App\Survey;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListUserSurveysTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_view_their_surveys()
    {
        $user = factory(User::class)->create();

        $user->surveys()->save(factory(Survey::class)->make([
            'title' => 'Dummy Title',
        ]));
        $user->surveys()->save(factory(Survey::class)->make([
            'title' => 'Another Title',
        ]));

        $this->assertDatabaseHas('surveys', [
            'user_id' => '1'
        ]);

        $this->actingAs($user)
            ->get('/surveys')
            ->assertStatus(200)
            ->assertSee('Dummy Title')
            ->assertSee('Another Title');
    }


    /** @test */
    function guest_can_not_view_list_of_surveys()
    {
        $this->withExceptionHandling()->get('/surveys')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }
}
