<?php

namespace Tests\Unit;

use App\User;
use App\Survey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_create_a_survey()
    {
        $user = factory(User::class)->create();

        $user->surveys()->create([
            'title' => 'New Survey',
        ]);

        $survey = $user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);
    }

    /** @test */
    function user_can_create_a_text_question()
    {
        $user = factory(User::class)->create();

        $survey = $user->surveys()->create([
            'title' => 'New Survey',
        ]);

        $survey->questions()->create([
            'order' => 1,
            'type_id' => 1,
            'question' => 'dummy question',
            'description' => 'dummy description',
        ]);
    }

    /** @test */
    function user_can_create_a_multi_answer_question()
    {
        $userId = factory(User::class)->create()->id;

        $survey = new Survey;

        $user = factory(User::class)->create();

        $survey = $user->surveys()->create([
            'title' => 'New Survey',
        ]);

        $question = $survey->questions()->create([
            'order' => 1,
            'type_id' => 1,
            'question' => 'dummy question',
            'description' => 'dummy description',
        ]);

        $question->options()->create([
            'order' => 1,
            'answer' => 'option 1',
        ]);

    }
}
