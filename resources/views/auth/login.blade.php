@extends('layouts.noauth')

@section('title', 'Sign In')

@section('content')
{{-- Left Side: Login Form --}}
<div class="flex justify-center items-center p-8 lg:p-10">
    <div class="kt-card max-w-[370px] w-full">
        <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="kt-card-content flex flex-col gap-5 p-10">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Sign In</h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">Need an account?</span>
                    <a class="text-sm link" href="{{ route('register.form') }}">Sign up</a>
                </div>
            </div>

            {{-- Email --}}
            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Email</label>
                <input class="kt-input" name="email" placeholder="email@email.com" type="email" required />
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            {{-- Password --}}
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between gap-1">
                    <label class="kt-form-label font-normal text-mono">Password</label>
                    <a class="text-sm kt-link shrink-0" href="{{ route('password.reset') }}">Forgot Password?</a>
                </div>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input name="password" placeholder="Enter Password" type="password" required />
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true" type="button">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </button>
                </div>
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            {{-- Remember Me --}}
            <label class="kt-label">
                <input class="kt-checkbox kt-checkbox-sm" name="remember" type="checkbox" />
                <span class="kt-checkbox-label">Remember me</span>
            </label>

            {{-- Submit --}}
            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">Sign In</button>
        </form>
    </div>
</div>

{{-- Right Side: Image Section --}}
<div class="lg:rounded-xl lg:border lg:border-border lg:m-5 bg-top xxl:bg-center xl:bg-cover bg-no-repeat"
     style="background-image:url('{{ asset('assets/media/images/2600x1600/1.png') }}');">
    <div class="flex flex-col p-8 lg:p-16 gap-4">
        <a href="#">
            <img class="h-[28px] max-w-none" src="{{ asset('assets/media/app/mini-logo.svg') }}" />
        </a>
        <div class="flex flex-col gap-3">
            <h3 class="text-2xl font-semibold text-mono">Secure Access Portal</h3>
            <div class="text-base font-medium text-secondary-foreground">
                A robust authentication gateway ensuring <br />
                secure <span class="text-mono font-semibold">efficient user access</span>
                to the Metronic Dashboard interface.
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let button = form.find('button[type="submit"]');
        button.prop('disabled', true).text('Processing...');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    window.location.href = response.redirect; 
                    alert(response.message);
                }
            },
            error: function (xhr) {
                button.prop('disabled', false).text('Sign In');
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let msg = 'Please fix the following errors:\n';
                    $.each(errors, function (key, value) {
                        msg += '- ' + value[0] + '\n';
                    });
                    alert(msg);
                } else {
                    alert('Login failed. Try again.');
                }
            }
        });
    });
});
</script>
@endsection
