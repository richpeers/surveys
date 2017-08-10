@extends('layouts.app')

@section('pageTitle', 'My Surveys')
@section('pageClass', 'shadow-under-nav')

@section('content')

    <div>

        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">My Surveys</h1>
                    <p class="subtitle">Manage your Surveys</p>
                </div>
            </div>
            <div class="hero-foot">
                <div class="container">
                    <nav class="tabs is-boxed">
                        <ul>
                            <li><a href="#">Account</a></li>
                            <li class="is-active"><a href="#">Surveys</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">

                <table class="table is-striped">
                    <tbody>
                    @foreach($surveys as $survey)
                        <tr>
                            <td>published</td>
                            <td>{{ $survey->title }}</td>
                            <td><a class="button" href="{{url('/surveys/' . $survey->id . '/edit')}}">Edit</a></td>
                            <td>impressions</td>
                            <td>hits</td>
                            <td>days</td>
                            <td>download responses</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </section>

    </div>

@endsection
