<?php

namespace Tests\Feature;

use App\User;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditSurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_edit_survey()
    {
        $user = factory(User::class)->create();

        $survey = $user->surveys()->save(factory(Survey::class)->make());

        $this->actingAs($user)
            ->get('/surveys/' . $survey->id . '/edit')
            ->assertStatus(200)
            ->assertSee('Edit Survey');
    }
}
