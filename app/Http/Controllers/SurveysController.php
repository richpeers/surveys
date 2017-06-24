<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Option;
use Illuminate\Http\Request;

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return response()->json(['created' => true], 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
