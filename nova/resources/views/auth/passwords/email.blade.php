@extends('nova::auth.layout')

@section('content')

@include('nova::auth.partials.header')

<form
    class="pos-relative bg-white shadow rounded-lg p-8 max-w-login mx-auto"
    method="POST"
    action="{{ route('nova.password.email') }}"
>
    {{ csrf_field() }}

    @component('nova::auth.partials.heading')
        {{ __('Reset your password') }}
    @endcomponent

    @if (session('status'))
    <div class="text-success text-center font-semibold my-3">
        {{ session('status') }}
    </div>
    @endif

    @include('nova::auth.partials.errors')

    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="block font-bold mb-2" for="email">{{ __('Email Address') }}</label>
        <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3 h-9">
        <button class="align-right btn btn-default btn-primary hover:bg-primary-dark" type="submit">
            {{ __('Send me instructions') }}
        </button>
    </div>

</form>
<div class="pos-relative text-center p-8 max-w-login mx-auto ">
    Remember your password?
    <a class="text-primary dim font-bold no-underline" href="{{ route('nova.login') }}">
        {{ __('Log in') }}
    </a>
</div>

@endsection
