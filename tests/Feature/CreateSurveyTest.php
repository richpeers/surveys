<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_visit_the_new_survey_form_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertStatus(200)
            ->assertSee('New Survey');
    }

    /** @test */
    function guest_can_visit_the_new_survey_form_page()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('New Survey');
    }



}
