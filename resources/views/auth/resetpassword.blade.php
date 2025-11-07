@extends('layouts.noauth')

@section('title', 'Reset Password')

@section('content')
<div class="flex justify-center items-center p-8 lg:p-10">
    <div class="kt-card max-w-[370px] w-full">
        <form id="resetForm" action="{{ route('password.update') }}" method="POST" class="kt-card-content flex flex-col gap-5 p-10">
            @csrf
            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Reset Password</h3>
                <p class="text-sm text-secondary-foreground">Enter your email and new password</p>
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Email</label>
                <input class="kt-input" name="email" placeholder="email@email.com" type="email" required />
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">New Password</label>
                <input class="kt-input" name="password" placeholder="Enter New Password" type="password" required />
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Confirm Password</label>
                <input class="kt-input" name="password_confirmation" placeholder="Confirm Password" type="password" required />
            </div>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">Reset Password</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    $('#resetForm').on('submit', function (e) {
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
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                button.prop('disabled', false).text('Reset Password');
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let msg = 'Please fix the following errors:\n';
                    $.each(errors, function (key, value) {
                        msg += '- ' + value[0] + '\n';
                    });
                    alert(msg);
                } else {
                    alert('Password reset failed. Try again.');
                }
            }
        });
    });
});
</script>
@endsection
