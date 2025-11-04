<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Metronic - Tailwind CSS Sign Up</title>

    {{-- Favicon & Fonts --}}
    <link rel="icon" href="{{ asset('assets/media/app/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

    {{-- Vendor & Theme Styles --}}
    <link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">

    <div class="grid lg:grid-cols-2 grow">
        {{-- LEFT SIDE (Form) --}}
        <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
            <div class="kt-card max-w-[370px] w-full">
                <form action="{{ route('register') }}" method="POST" class="kt-card-content flex flex-col gap-5 p-10">
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

                    {{-- Full Name --}}
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label text-mono">Full Name</label>
                        <input class="kt-input" name="name" placeholder="John Doe" type="text" required />
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label text-mono">Email</label>
                        <input class="kt-input" name="email" placeholder="email@email.com" type="email" required />
                    </div>

                    {{-- Password --}}
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

                    {{-- Confirm Password --}}
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

                    {{-- Checkbox --}}
                    <label class="kt-checkbox-group">
                        <input class="kt-checkbox kt-checkbox-sm" name="terms" type="checkbox" required />
                        <span class="kt-checkbox-label">
                            I accept <a class="text-sm link" href="#">Terms & Conditions</a>
                        </span>
                    </label>

                    {{-- Submit --}}
                    <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">Sign Up</button>
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
                        secure <span class="text-mono font-semibold">efficient user access</span>
                        to the Metronic Dashboard interface.
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/ktui/ktui.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
</body>
</html>
