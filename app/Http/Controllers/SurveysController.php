<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSurvey;
use App\Survey;
use App\Option;

/**
 * Class SurveysController
 * @package App\Http\Controllers
 */
class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $surveys = $request->user()->surveys()->get();

        return view('surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSurvey $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurvey $request)
    {
        // Create Survey
        $survey = $request->user()->surveys()->create([
            'title' => $request->title,
        ]);

        // Add Questions to Survey
        foreach ($request->questions as $q) {
            $question = $survey->questions()->create([
                'order' => $q['order'],
                'type_id' => $q['type_id'],
                'title' => $q['title'],
                'description' => $q['description'],
                'required' => $q['required'],
                'comment_placeholder' => $q['comment_placeholder']
            ]);

            // Add Options to Questions
            if (isset($q['options'])) {
                $options = [];
                foreach ($q['options'] as $option) {
                    $options[] = new Option([
                        'order' => $option['order'],
                        'answer' => $option['answer'],
                        'canComment' => $option['canComment']
                    ]);
                };
                $question->options()->saveMany($options);
            }
        }
        return response()->json([
            'created' => true,
            'redirect' => route('surveys'),
        ], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::with('questions.options')->findOrFail($id)->toJson();
        return view('surveys.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreSurvey $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSurvey $request, $id)
    {
        $survey = Survey::with('questions.options')->findOrFail($id);

        $questions = collect($request->questions)->transform(function ($question) {
            $question['id'] = isset($question['id']) ? $question['id'] : 0;
            return $question;
        });

        //update survey
        $survey->title = $request->title;
        $survey->save();

        // soft delete questions not included in updated survey
        $questionsToSoftDelete = $survey->questions()->whereNotIn('id', $questions->pluck('id'));

        $questionsToSoftDelete->each(function ($question) {
            $question->options()->delete();
        });

        $questionsToSoftDelete->delete();

        //update or create questions
        $questions->each(function ($q) use ($survey) {

            $question = $survey->questions()->updateOrCreate(
                [
                    'id' => $q['id']
                ],
                [
                    'order' => $q['order'],
                    'type_id' => $q['type_id'],
                    'title' => $q['title'],
                    'description' => $q['description'],
                    'required' => $q['required'],
                    'comment_placeholder' => $q['comment_placeholder']
                ]
            );

            $options = collect($q['options'])->transform(function ($option) {
                $option['id'] = isset($option['id']) ? $option['id'] : 0;
                return $option;
            });

            // soft delete answer options not included in updated question
            $question->options()->whereNotIn('id', $options->pluck('id'))->delete();

            //update or create answer options
            $options->each(function ($option) use ($question) {

                $question->options()->updateOrCreate(
                    [
                        'id' => $option['id']
                    ],
                    [
                        'order' => $option['order'],
                        'answer' => $option['answer'],
                        'canComment' => $option['canComment']
                    ]
                );
            });

        });
        return response()->json([
            'updated' => true,
            'redirect' => route('surveys'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
