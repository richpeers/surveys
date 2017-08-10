<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Survey;
use App\Question;
use App\Option;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateSurveyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_update_a_survey()
    {

        $user = factory(User::class)->create();

        $survey = factory(Survey::class)->create(['user_id' => $user->id]);

        factory(Question::class, 3)->create([
            'survey_id' => $survey->id,
            'type_id' => 3,
        ])
            ->each(function ($question) {
                $question->options()->save(factory(Option::class)->make([
                    'question_id' => $question->id
                ]));
                $question->options()->save(factory(Option::class)->make([
                    'question_id' => $question->id
                ]));
            });

        $this->actingAs($user)
            ->json('PUT', '/surveys/' . $survey->id, [
                'title' => 'updated survey title',
                'questions' => [
                    [
                        'id' => 3,
                        'order' => 1,
                        'type_id' => 3,
                        'title' => 'updated question title 3',
                        'description' => 'updated description 3',
                        'required' => 1,
                        'comment_placeholder' => 'updated comment placeholder',
                        'options' => [
                            [
                                'id' => 5,
                                'order' => 1,
                                'answer' => 'updated answer 5',
                                'canComment' => false
                            ],
                            [
                                'order' => 2,
                                'answer' => 'new answer',
                                'canComment' => true
                            ]
                        ],
                    ],
                    [
                        'id' => 1,
                        'order' => 2,
                        'type_id' => 3,
                        'title' => 'updated question title 1',
                        'description' => 'updated description 1',
                        'required' => 1,
                        'comment_placeholder' => 'updated comment placeholder',
                        'options' => [
                            [
                                'id' => 2,
                                'order' => 1,
                                'answer' => 'updated answer 2',
                                'canComment' => false
                            ],
                            [
                                'id' => 1,
                                'order' => 2,
                                'answer' => 'updated answer 1',
                                'canComment' => true
                            ]
                        ],
                    ],
                    [
                        'order' => 3,
                        'type_id' => 3,
                        'title' => 'new question title',
                        'description' => 'new question description',
                        'required' => 1,
                        'comment_placeholder' => 'new comment placeholder',
                        'options' => [
                            [
                                'order' => 1,
                                'answer' => 'new answer 1',
                                'canComment' => false
                            ],
                            [
                                'order' => 2,
                                'answer' => 'new answer 2',
                                'canComment' => true
                            ]
                        ],
                    ]
                ]
            ])
            ->assertStatus(200)
            ->assertJson([
                'updated' => true
            ]);

        $this->assertDatabaseHas('surveys', ['title' => 'updated survey title'])
            ->assertDatabaseHas('questions', ['id' => 1, 'title' => 'updated question title 1'])
            ->assertDatabaseHas('questions', ['title' => 'new question title'])
            ->assertDatabaseHas('options', ['id' => 2, 'answer' => 'updated answer 2'])
            ->assertDatabaseHas('options', ['answer' => 'new answer'])
            ->assertSoftDeleted('questions', ['id' => 2])
            ->assertSoftDeleted('options', ['id' => 3])
            ->assertSoftDeleted('options', ['id' => 6])
            ->assertDatabaseMissing('questions', ['id' => 0]);
    }
}
