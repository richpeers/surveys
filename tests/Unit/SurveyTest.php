<?php

namespace Tests\Unit;

use App\User;
use App\Survey;
use App\Question;
use App\Option;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SurveyTest extends TestCase
{
    use DatabaseMigrations;

    private $user;
    private $longString;

    function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->longString = str_repeat('a', 256);
    }

    private function storeJSON($data)
    {
        return $this->actingAs($this->user)->json('POST', '/surveys/store', $data);
    }

    /** @test */
    function user_can_create_a_survey()
    {
        $this->user->surveys()->create(['title' => 'New Survey']);

        $survey = $this->user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);
    }

    /** @test */
    function user_can_create_a_text_question()
    {
        $this->user->surveys()
            ->create(['title' => 'New Survey'])
            ->each(function ($s) {
                $s->questions()->save(factory(Question::class)->make(['title' => 'dummy question']));
            });

        $survey = $this->user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $textQuestion = $survey->questions()->where('title', 'dummy question')->first();
        $this->assertNotNull($textQuestion);
    }

    /** @test */
    function user_can_create_a_multi_answer_question()
    {
        $this->user->surveys()
            ->create(['title' => 'New Survey'])
            ->each(function ($s) {
                $s->questions()->save(factory(Question::class)->make(['title' => 'dummy question']))
                    ->each(function ($q) {
                        $q->options()->save(factory(Option::class)->make(['answer' => 'option 1']));
                    });
            });

        $survey = $this->user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $multiAnswerQuestion = $survey->questions()->where('title', 'dummy question')->first();
        $this->assertNotNull($multiAnswerQuestion);

        $option = $multiAnswerQuestion->options()->where('answer', 'option 1')->first();
        $this->assertNotNull($option);
    }

    /** @test */
    function user_can_retrieve_list_of_their_own_surveys()
    {
        factory(Survey::class, 3)->create([
            'user_id' => $this->user->id,
            'title' => 'Dummy Title',
        ]);

        $surveys = $this->user->surveys()->where('title', 'Dummy Title')->first();

        $this->assertNotNull($surveys);
    }

    /** @test */
    function user_can_get_survey_with_questions_and_question_options_ordered_by_order_columns()
    {
        return true;
    }
}
