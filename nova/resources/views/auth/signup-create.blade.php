@extends('nova::auth.signup-layout')

@section('content')

@include('nova::auth.partials.signup-header')

<form
    class="pos-relative max-w-login mx-auto "
    method="POST"
    action="{{ route('nova.signup.final') }}"
>
    {{ csrf_field() }}

    @component('nova::auth.partials.heading')
        {{ __('Create your account') }}
    @endcomponent


    <div class="mb-6">
        Write your personal information
    </div>
    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2 login-email" for="email">{{ __('Complete name') }}</label>
        <input class="form-control form-input form-input-bordered w-full input-name h-10" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>


    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2 login-email d-inline" for="password">{{ __('Password') }}</label>
        <input class="form-control form-input form-input-bordered w-full input-email h-10" id="password" type="password" name="password" required>
    </div>


    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2 login-email" for="email">{{ __('Name one of your business unit') }}</label>
        <input class="form-control form-input form-input-bordered w-full input-name h-10" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2 login-email" for="email">{{ __('Name the team responsible for the unit') }}</label>
        <input class="form-control form-input form-input-bordered w-full input-name h-10" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
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
            {{ __('Continue') }}
        </button>
    </div>


    {{-- <div class="flex mb-6">
        <label class="flex items-center text-xl font-bold">
            <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="text-base ml-2">{{ __('Remember Me') }}</span>
        </label>



    </div> --}}


</form>
@endsection
