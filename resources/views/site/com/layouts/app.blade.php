<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Mental Health & Therapy')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('css/vendor/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --primary-color:
                {{ $settings['primary_color'] ?? '#044A80' }}
            ;
            --secondary-color:
                {{ $settings['secondary_color'] ?? '#ffbf00' }}
            ;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .line-clamp-6 {
            display: -webkit-box;
            -webkit-line-clamp: 6;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .service-description {
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    @include('site.com.partials.header')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('site.com.partials.footer')

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/aos.js') }}"></script>
    <script src="{{ asset('js/vendor/swiper-bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/video-player.js') }}"></script>
    <script src="{{ asset('js/script-counter.js') }}"></script>
    <script src="{{ asset('js/script-swiper.js') }}"></script>

    <script>
        AOS.init();
    </script>

    <!-- Join Us Modal -->
    <div class="modal fade" id="joinUsModal" tabindex="-1" aria-labelledby="joinUsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5">
                    @if(empty($settings['therapist_application_url']))
                        <div class="text-center py-4">
                            <i class="bi bi-exclamation-triangle-fill text-danger display-1 mb-4"></i>
                            <h3 class="fw-bold">Broken Link</h3>
                            <p class="text-muted fs-5">Google forms link is broken please check.</p>
                        </div>
                    @else
                        <div class="text-center mb-4">
                            <h2 class="fw-bold font-1">Join Our Growing Team</h2>
                            <p class="text-muted small">Are you a compassionate mental health professional? We should talk.
                            </p>
                        </div>

                        <form id="globalTherapistJoinForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Full Name*</label>
                                    <input type="text" name="name"
                                        class="form-control py-2 rounded-3 border-secondary-subtle" required
                                        placeholder="Joy Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Email Address*</label>
                                    <input type="email" name="email"
                                        class="form-control py-2 rounded-3 border-secondary-subtle" required
                                        placeholder="joy@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Phone Number*</label>
                                    <input type="tel" name="phone"
                                        class="form-control py-2 rounded-3 border-secondary-subtle" required
                                        placeholder="+91 XXXXX XXXXX">
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="form-label small fw-bold text-muted text-uppercase">Specialization*</label>
                                    <input type="text" name="specialization"
                                        class="form-control py-2 rounded-3 border-secondary-subtle" required
                                        placeholder="Clinical Psychology, CBT, etc.">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Years of
                                        Experience*</label>
                                    <select name="experience" class="form-select py-2 rounded-3 border-secondary-subtle"
                                        required>
                                        <option value="" disabled selected>Select experience</option>
                                        <option value="0-2 years">0-2 years</option>
                                        <option value="2-5 years">2-5 years</option>
                                        <option value="5-10 years">5-10 years</option>
                                        <option value="10+ years">10+ years</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted text-uppercase">Short
                                        Bio/Message</label>
                                    <textarea name="message" class="form-control rounded-3 border-secondary-subtle" rows="4"
                                        placeholder="Tell us about yourself..."></textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-3 rounded-pill fw-bold text-uppercase"
                                        style="background-color: var(--primary-color); border: none;">
                                        Submit Application
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="globalJoinResponse" class="mt-4" style="display: none;"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal (Compact Dark Theme) -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4 class="modal-title font-1 mb-0" id="loginModalLabel">Login to YWP</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loginModalAlert"
                        class="alert alert-danger d-none rounded-3 small py-2 border-0 bg-danger text-white mb-3"
                        role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i> <span></span>
                    </div>

                    <form id="ajaxLoginForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label small" for="rememberMe">Remember</label>
                            </div>
                            <a href="#" class="small text-decoration-none">Forgot?</a>
                        </div>
                        <button type="submit" class="btn btn-primary-solid w-100">
                            Sign In
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="small text-white-50 mb-0">No account?
                            <a href="{{ route('com.register') }}"
                                class="text-white fw-bold text-decoration-none border-bottom border-white border-opacity-25">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('js')

    <script>
        // AJAX Login Handling
        document.getElementById('ajaxLoginForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = form.querySelector('button[type="submit"]');
            const alert = document.getElementById('loginModalAlert');
            const formData = new FormData(form);

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Logging in...';
            alert.classList.add('d-none');

            fetch("{{ route('login.ajax') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert.querySelector('span').innerText = data.message || 'Login failed. Please check your credentials.';
                        alert.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    alert.querySelector('span').innerText = 'Something went wrong. Please try again.';
                    alert.classList.remove('d-none');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = 'Sign In';
                });
        });
    </script>

    <script>
        document.getElementById('globalTherapistJoinForm')?.addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const btn = form.querySelector('button[type="submit"]');
            const responseDiv = document.getElementById('globalJoinResponse');
            const formData = new FormData(form);

            btn.disabled = true;
            const originalText = btn.innerText;
            btn.innerText = 'Submitting...';
            responseDiv.style.display = 'none';

            fetch("{{ route('com.therapist.application.submit') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    responseDiv.style.display = 'block';
                    if (data.success) {
                        responseDiv.innerHTML = `<div class="alert alert-success rounded-4 border-0 shadow-sm p-3">
                        <i class="bi bi-check-circle-fill me-2"></i> ${data.message}
                    </div>`;
                        form.reset();
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('joinUsModal'));
                            modal.hide();
                            responseDiv.style.display = 'none';
                        }, 3000);
                    } else {
                        responseDiv.innerHTML = `<div class="alert alert-danger rounded-4 border-0 shadow-sm p-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> ${data.message}
                    </div>`;
                    }
                })
                .catch(error => {
                    responseDiv.style.display = 'block';
                    responseDiv.innerHTML = `<div class="alert alert-danger rounded-4 border-0 shadow-sm p-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Something went wrong. Please try again later.
                </div>`;
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerText = originalText;
                });
        });
    </script>
</body>

</html>