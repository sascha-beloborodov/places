@extends('layout')

@section('content')

    {!! Form::open(['url' => route('auth.register-post'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

    @include('includes.errors')

    <h2 class="form-signin-heading">Please register</h2>

    <label for="inputEmail" class="sr-only">Email address</label>
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus' ]) !!}

    <label for="inputFirstName" class="sr-only">First name</label>
    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name', 'required' ]) !!}

    <label for="inputLastName" class="sr-only">Last name</label>
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name', 'required' ]) !!}


    <label for="inputPassword" class="sr-only">Password</label>
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' ]) !!}


    <label for="inputPasswordConfirm" class="sr-only">Confirm Password</label>
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password confirmation', 'required' ]) !!}


    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

    <p class="or-social">Or Use Yandex Auth</p>

    <a href="{{ route('social.redirect', ['provider' => 'yandex']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Yandex</a>

    {!! Form::close() !!}


@stop