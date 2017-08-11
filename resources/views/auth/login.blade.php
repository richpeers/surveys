@extends('auth.layout')

@section('pageTitle', 'Login')

@section('content')
    <form role="form" method="POST" action="{{ route('login') }}">

        <h1 class="title is-2 has-text-centered">Log In</h1>

        {{ csrf_field() }}

        <div class="field">
            <div class="control">
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                       class="input is-medium" required autofocus>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <input id="password" type="password" name="password" placeholder="Password"
                       class="input is-medium" required>
            </div>
        </div>

        <p class="field has-text-white">
            @if ($errors->has('email'))
                {{ $errors->first('email') }}
            @endif
        </p>


        <div class="auth-footer">

            <button type="submit" class="button is-medium is-success">
                Log In
            </button>
            <a href="{{ route('register') }}" class="button is-success">Register</a>

            <a href="{{ route('password.request') }}" class="button is-success">Forgot Password?</a>


        </div>


    </form>
@endsection
