@extends('layouts.noauth')

@section('title', 'Sign Up')

@section('content')
    <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
        <div class="kt-card max-w-[370px] w-full">
            <form action="{{ route('register.post') }}" method="POST" class="kt-card-content flex flex-col gap-5 p-10">
                @csrf

                <div class="text-center mb-2.5">
                    <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Sign Up</h3>
                    <div class="flex items-center justify-center">
                        <span class="text-sm text-secondary-foreground me-1.5">
                            Already have an Account?
                        </span>
                        <a class="text-sm link" href="{{ route('login') }}">Sign In</a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="kt-form-label text-mono">Full Name</label>
                    <input class="kt-input" name="name" placeholder="John Doe" type="text" required />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="kt-form-label text-mono">Email</label>
                    <input class="kt-input" name="email" placeholder="email@email.com" type="email" required />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Password</label>
                    <div class="kt-input" data-kt-toggle-password="true">
                        <input name="password" placeholder="Enter Password" type="password" required />
                        <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                            data-kt-toggle-password-trigger="true" type="button">
                            <i class="ki-filled ki-eye text-muted-foreground"></i>
                        </button>
                    </div>
                </div>

             
                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Confirm Password</label>
                    <div class="kt-input" data-kt-toggle-password="true">
                        <input name="password_confirmation" placeholder="Re-enter Password" type="password" required />
                        <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                            data-kt-toggle-password-trigger="true" type="button">
                            <i class="ki-filled ki-eye text-muted-foreground"></i>
                        </button>
                    </div>
                </div>

                <label class="kt-checkbox-group">
                    <input class="kt-checkbox kt-checkbox-sm" name="terms" type="checkbox" required />
                    <span class="kt-checkbox-label">
                        I accept <a class="text-sm link" href="#">Terms & Conditions</a>
                    </span>
                </label>

                <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">Sign Up</button>
            </form>
        </div>
    </div>

    <div class="lg:rounded-xl lg:border lg:border-border lg:m-5 order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat"
        style="background-image:url('{{ asset('assets/media/images/2600x1600/1.png') }}');">
        <div class="flex flex-col p-8 lg:p-16 gap-4">
            <a href="#">
                <img class="h-[28px] max-w-none" src="{{ asset('assets/media/app/mini-logo.svg') }}" />
            </a>
            <div class="flex flex-col gap-3">
                <h3 class="text-2xl font-semibold text-mono">Create Your Account</h3>
                <div class="text-base font-medium text-secondary-foreground">
                    Join our platform and enjoy <br />
                    a <span class="text-mono font-semibold">secure dashboard experience</span>.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form').on('submit', function (e) {
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
                    alert(response.message);
                    window.location.href = response.redirect; 
                }
            },
            error: function (xhr) {
                button.prop('disabled', false).text('Sign Up');
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let message = 'Please fix the following errors:\n';
                    $.each(errors, function (key, value) {
                        message += '- ' + value[0] + '\n';
                    });
                    alert(message);
                } else {
                    alert('Something went wrong. Please try again.');
                }
            }
        });
    });
});
</script>
@endsection
