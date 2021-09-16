@extends('nova::auth.layout')

@section('content')

@include('nova::auth.partials.header')

<form
    class="pos-relative bg-white shadow rounded-lg p-8 max-w-login mx-auto login-form"
    method="POST"
    action="{{ route('nova.login') }}"
>
    {{ csrf_field() }}

    @component('nova::auth.partials.heading')
        {{ __('Sign in to your account') }}
    @endcomponent



    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2 login-email" for="email">{{ __('Email Address') }}</label>
        <input class="form-control form-input form-input-bordered w-full input-email h-10" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="row mb-4">
            <label class="block font-bold mb-2 login-email d-inline" for="password">{{ __('Password') }}</label>
            @if (\Laravel\Nova\Nova::resetsPasswords())
            <div class="ml-auto d-inline align-right">
                <a class="text-primary dim font-bold no-underline" href="{{ route('nova.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
            @endif
        </div>

        <input class="form-control form-input form-input-bordered w-full input-email h-10" id="password" type="password" name="password" required>


    </div>

    @if ($errors->any())
    <p class="text-left font-semibold text-danger my-3">x
        @if ($errors->has('email'))
            {{ $errors->first('email') }}
        @else
            {{ $errors->first('password') }}
        @endif
        </p>
    @endif
    <div class="mb-6 h-9">
        <button class="pos-relative h-10 align-right ml-auto btn btn-default btn-primary hover:bg-primary-dark" type="submit">
            {{ __('Log in') }}
        </button>
    </div>


    {{-- <div class="flex mb-6">
        <label class="flex items-center text-xl font-bold">
            <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="text-base ml-2">{{ __('Remember Me') }}</span>
        </label>



    </div> --}}

    <p class="fake-legend"><span>Or sign in with</span>
    </p>


    <div class="signin-with">
        <div class="customBtn customGPlusSignIn text-center">
            <a class=" btn  text-center" href="{{ route('nova.login.google') }}">
                <span class="icon-google"></span>
                <span class="buttonText">Google</span>
            </a>
        </div>
        <div class="customBtn align-right customGPlusSignIn text-center">
            <a class=" btn  text-center" href="{{ route('nova.login.linkedin') }}">
                <span class="icon-linkedin"></span>
                <span class="buttonText">LinkedIN</span>
            </a>
        </div>
    </div>


</form>
<div class="pos-relative text-center p-8 max-w-login mx-auto ">
    Don't have an account?
    <a class="text-primary dim font-bold no-underline" href="{{ route('nova.signup') }}">
        {{ __('Sign up') }}
    </a>
</div>
@endsection
