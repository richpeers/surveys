<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StoreSurveyTest extends TestCase
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
    function user_can_store_a_new_survey()
    {
        $this->actingAs($this->user)
            ->json('POST', '/surveys/store', [
                'title' => 'New Survey',
                'questions' => [
                    [
                        'order' => 1,
                        'type_id' => 1,
                        'title' => 'text only question',
                        'description' => 'description',
                        'required' => 1,
                        'comment_placeholder' => 'comment placeholder'
                    ],
                    [
                        'order' => 2,
                        'type_id' => 2,
                        'title' => 'multi answer question',
                        'description' => 'description',
                        'required' => 1,
                        'comment_placeholder' => 'comment placeholder',
                        'options' => [
                            [
                                'order' => 1,
                                'answer' => 'option 1',
                                'canComment' => false
                            ],
                            [
                                'order' => 2,
                                'answer' => 'option 2',
                                'canComment' => true
                            ]
                        ],
                    ]
                ]
            ])
            ->assertStatus(201)
            ->assertJson([
                'created' => true
            ]);

        $survey = $this->user->surveys()->where('title', 'New Survey')->first();
        $this->assertNotNull($survey);

        $textQuestion = $survey->questions()->where('title', 'text only question')->first();
        $this->assertNotNull($textQuestion);

        $multiAnswerQuestion = $survey->questions()->where('title', 'multi answer question')->first();
        $this->assertNotNull($multiAnswerQuestion);

        $option = $multiAnswerQuestion->options()->where('answer', 'option 1')->first();
        $this->assertNotNull($option);
    }

    /** @test */
    function guest_cannot_store_a_new_survey()
    {
        $this->put('/surveys/store')
            ->assertStatus(405);
//            ->assertRedirect('/login');
    }

    /** @test */
    function survey_title_is_required()
    {
        $this->storeJSON([
            'title' => ''
        ])
            ->assertStatus(422)
            ->assertJson(['title' => ['The title field is required.']]);
    }

    /** @test */
    function survey_title_length_max_255()
    {
        $this->storeJSON([
            'title' => $this->longString
        ])
            ->assertStatus(422)
            ->assertJson(['title' => ['The title may not be greater than 140 characters.']]);
    }

    /** @test */
    function at_least_one_question_is_required()
    {
        $this->storeJSON([
            'questions' => []
        ])
            ->assertStatus(422)
            ->assertJson(['questions' => ['The questions must have at least 1 items.']]);
    }

    /** @test */
    function question_description_is_optional()
    {
        $this->storeJSON([
            'title' => 'New Survey',
            'questions' => [
                [
                    'order' => 1,
                    'type_id' => 1,
                    'title' => 'text only question',
                    'description' => '',
                    'required' => 1,
                    'comment_placeholder' => 'comment placeholder'
                ]
            ]
        ])
            ->assertStatus(201)
            ->assertJson(['created' => true]);
    }

    /** @test */
    function question_description_length_max_255()
    {
        $this->storeJSON([
            'title' => 'New Survey',
            'questions' => [
                [
                    'description' => $this->longString
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.description' => ['The questions.0.description may not be greater than 255 characters.']]);
    }

    /** @test */
    function question_order_is_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'order' => ''
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.order' => ['The questions.0.order field is required.']]);
    }

    /** @test */
    function question_order_must_be_an_integer()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'order' => 'a'
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.order' => ['The questions.0.order must be an integer.']]);
    }

    /** @test */
    function question_order_must_be_min_1()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'order' => '0'
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.order' => ['The questions.0.order must be at least 1.']]);
    }

    /** @test */
    function question_type_id_is_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => ''
                ]
            ]

        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.type_id' => ['The questions.0.type_id field is required.']]);
    }

    /** @test */
    function question_type_id_must_be_an_integer()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 'a'
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.type_id' => ['The questions.0.type_id must be an integer.']]);
    }

    /** @test */
    function question_type_id_must_be_between_1_and_9()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 0
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.type_id' => ['The questions.0.type_id must be between 1 and 9.']]);
    }

    /** @test */
    function question_required_is_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'title' => 'title'
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.required' => ['The questions.0.required field is required.']]);
    }

    /** @test */
    function question_required_is_boolean()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'required' => 2
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.required' => ['The questions.0.required field must be true or false.']]);
    }

    /** @test */
    function question_options_required_if_type_id_is_2_3_or_4()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options' => ['The questions.0.options field is required when questions.0.type_id is 2.']]);

    }

    /** @test */
    function question_option_order_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'answer' => 'test answer'
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.order' => ['The questions.0.options.0.order field is required.']]);
    }

    /** @test */
    function question_option_order_must_be_an_integer()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'order' => 'a'
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.order' => ['The questions.0.options.0.order must be an integer.']]);
    }

    /** @test */
    function question_option_order_must_be_unsigned()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'order' => '-1'
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.order' => ['The questions.0.options.0.order must be at least 1.']]);
    }

    /** @test */
    function question_options_answer_is_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'order' => '1'
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.answer' => ['The questions.0.options.0.answer field is required.']]);
    }

    /** @test */
    function question_option_answer_is_max_255_chars()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'answer' => $this->longString
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.answer' => ['The questions.0.options.0.answer may not be greater than 140 characters.']]);
    }

    /** @test */
    function question_option_can_comment_is_required()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'order' => 1
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.canComment' => ['The questions.0.options.0.canComment field is required.']]);
    }

    /** @test */
    function question_option_can_comment_must_be_boolean()
    {
        $this->storeJSON([
            'questions' => [
                [
                    'type_id' => 2,
                    'options' => [
                        [
                            'canComment' => 2
                        ]
                    ]
                ]
            ]
        ])
            ->assertStatus(422)
            ->assertJson(['questions.0.options.0.canComment' => ['The questions.0.options.0.canComment field must be true or false.']]);
    }

}
