@extends('layout')

@section('content')


    {!! Form::open(['url' => route('auth.login-post'), 'class' => 'form-signin', 'data-parsley-validate' ] ) !!}

    @include('includes.status')

    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus', 'id' => 'inputEmail' ]) !!}
    <label for="inputPassword" class="sr-only">Password</label>
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required',  'id' => 'inputPassword' ]) !!}

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

    <p class="or-social">Or Use Yandex Auth</p>

    <a href="{{ route('social.redirect', ['provider' => 'yandex']) }}" class="btn btn-lg btn-primary btn-block facebook" type="submit">Yandex</a>

    {!! Form::close() !!}

@stop