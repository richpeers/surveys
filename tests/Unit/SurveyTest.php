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
            'title' => 'dummy question',
            'description' => 'dummy description',
            'comment_placeholder' => 'More info (optional)'
        ]);

        $survey = $user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $textQuestion = $survey->questions()->where('title', 'dummy question')->first();
        $this->assertNotNull($textQuestion);
    }

    /** @test */
    function user_can_create_a_multi_answer_question()
    {
        $user = factory(User::class)->create();

        $survey = $user->surveys()->create([
            'title' => 'New Survey',
        ]);

        $question = $survey->questions()->create([
            'order' => 1,
            'type_id' => 1,
            'title' => 'dummy question',
            'description' => 'dummy description',
            'comment_placeholder' => 'More info (optional)'
        ]);

        $question->options()->create([
            'order' => 1,
            'answer' => 'option 1',
            'canComment' => false
        ]);

        $survey = $user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $multiAnswerQuestion = $survey->questions()->where('title', 'dummy question')->first();
        $this->assertNotNull($multiAnswerQuestion);

        $option = $multiAnswerQuestion->options()->where('answer', 'option 1')->first();
        $this->assertNotNull($option);
    }
}
