@extends('layouts.noauth')

@section('title', 'Reset Password')

@section('content')
<div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
    <div class="kt-card max-w-[370px] w-full">
        <form action="{{ route('password.update') }}" method="POST" class="kt-card-content flex flex-col gap-5 p-10">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Reset Password</h3>
                <span class="text-sm text-secondary-foreground">Enter your email and new password</span>
            </div>

            {{-- Email --}}
            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">Email</label>
                <input name="email" placeholder="email@example.com" type="email" required />
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">New Password</label>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input name="password" placeholder="Enter new password" type="password" required />
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true" type="button">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </button>
                </div>
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">Confirm Password</label>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input name="password_confirmation" placeholder="Confirm new password" type="password" required />
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true" type="button">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">Reset Password</button>

            {{-- Status message --}}
            @if (session('status'))
                <div class="text-green-600 text-center mt-2 text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif
        </form>
    </div>
</div>

{{-- RIGHT SIDE (Banner) --}}
<div class="lg:rounded-xl lg:border lg:border-border lg:m-5 order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat"
     style="background-image:url('{{ asset('assets/media/images/2600x1600/1.png') }}');">
    <div class="flex flex-col p-8 lg:p-16 gap-4">
        <a href="#">
            <img class="h-[28px] max-w-none" src="{{ asset('assets/media/app/mini-logo.svg') }}" />
        </a>
        <div class="flex flex-col gap-3">
            <h3 class="text-2xl font-semibold text-mono">Secure Access Portal</h3>
            <div class="text-base font-medium text-secondary-foreground">
                A robust authentication gateway ensuring <br />
                secure <span class="text-mono font-semibold">efficient user access</span> to the Dashboard.
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // ✅ CSRF token setup for all AJAX calls
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ✅ Handle password reset submit
    $('#resetForm').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let button = form.find('button[type="submit"]');
        button.prop('disabled', true).text('Resetting...');

        $.ajax({
            url: "{{ route('password.update') }}", // Your route name
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    form[0].reset();
                    window.location.href = response.redirect;
                } else {
                    alert(response.message || 'Unable to reset password.');
                }
                button.prop('disabled', false).text('Reset Password');
            },
            error: function(xhr) {
                button.prop('disabled', false).text('Reset Password');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let message = "Please fix the following:\n";
                    $.each(errors, function(key, value) {
                        message += "- " + value[0] + "\n";
                    });
                    alert(message);
                } else {
                    alert("Something went wrong! Please try again.");
                    console.error(xhr.responseText);
                }
            }
        });
    });
});
</script>
@endsection
