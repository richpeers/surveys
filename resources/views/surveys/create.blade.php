@extends('layouts.app')

@section('pageTitle', 'New Survey')
@section('pageClass', 'shadow-under-nav')

@section('content')

    <create inline-template>
        <div>

            <section class="hero is-primary">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">Create a Survey</h1>
                        <p class="subtitle">Embed a widget on your website</p>
                    </div>
                </div>
                <div class="hero-foot">
                    <div class="container">
                        <nav class="tabs is-boxed">
                            <ul>
                                <li><a href="#">Style</a></li>
                                <li class="is-active"><a href="#">Content</a></li>
                                <li><a href="#">Options</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container">
                    <div class="columns">
                        <div class="column">

                            <h2 class="title is-4">Survey Questions</h2>

                            <draggable id="questions"
                                       v-bind:class="{ 'obvious-drop-area': questionsEmpty }"
                                       v-model="questions"
                                       :options="DragQuestionOptions">
                                <question
                                        v-for="(question, index) in questions"
                                        v-bind:key="index"
                                        v-bind:question="question"
                                        v-bind:index="index"
                                        v-on:remove_question="removeQuestion"
                                ></question>
                            </draggable>

                        </div>
                        <div class="column">

                            <h2 class="title is-4">Available Types<span class="subtitle"><i> - drag & drop into
                                        Survey Questions</i></span></h2>

                            <draggable id="available"
                                       v-model="available"
                                       :options="DragAvailableOptions">
                                <available-question
                                        v-for="(question, index) in available"
                                        v-bind:key="index"
                                        v-bind:type="question.type"
                                ></available-question>
                            </draggable>

                        </div>

                    </div>
                </div>
            </section>


        </div>
    </create>

@endsection
