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
            ->get('/surveys/create')
            ->assertStatus(200)
            ->assertSee('New Survey');
    }

    /** @test */
    function guest_can_not_visit_the_new_survey_form_page()
    {
        $this->get('/surveys/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    function user_can_store_a_new_survey()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->json('POST', '/surveys/store', [
                'title' => 'New Survey',
                'questions' => [
                    [
                        'order' => 1,
                        'type_id' => 1,
                        'question' => 'text only question',
                        'description' => 'description',
                        'required' => 1,
                    ],
                    [
                        'order' => 2,
                        'type_id' => 2,
                        'question' => 'multi answer question',
                        'description' => 'description',
                        'required' => 1,
                        'options' => [
                            [
                                'order' => 1,
                                'answer' => 'option 1',
                            ],
                            [
                                'order' => 2,
                                'answer' => 'option 2',
                            ]
                        ],
                    ]
                ]
            ]);

        $survey = $user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $textQuestion = $survey->questions()->where('question', 'text only question')->first();
        $this->assertNotNull($textQuestion);

        $multiAnswerQuestion = $survey->questions()->where('question', 'multi answer question')->first();
        $this->assertNotNull($multiAnswerQuestion);

        $option = $multiAnswerQuestion->options()->where('answer', 'option 1')->first();
        $this->assertNotNull($option);
    }
}
