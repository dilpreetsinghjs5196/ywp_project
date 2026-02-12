@extends('site.com.layouts.app')

@section('title', 'Contact Us')

@section('content')
    @php
        $bgImagePath = $contents['banner']['banner_bg_image'] ?? 'image/footer-img.jpg';
        $bgFullUrl = Str::startsWith($bgImagePath, 'image/') ? asset($bgImagePath) : asset('storage/' . $bgImagePath);
    @endphp

    <!-- Banner Section -->
    <section class="section position-relative"
        style="background-image: url('{{ $bgFullUrl }}'); height: 40vh; background-size: cover; background-position: center;">
        <div class="bg-overlay-secondary"></div>
        <div class="b-container h-100 position-relative pt-4 text-white" style="z-index: 2;">
            <div
                class="col-10 d-flex flex-column w-100 h-100 justify-content-center align-items-center text-center text-white gap-3 font-1">
                <h1 class="display-2 mb-0" style="font-weight: 900;">Contact Us</h1>
                <nav aria-label="breadcrumb" style="font-weight: 900;">
                    <ol class="breadcrumb justify-content-center align-items-center">
                        <li class="breadcrumb-item font-1">
                            <a class="text-decoration-none text-white" href="{{ route('com.home') }}">Homepage</a>
                        </li>
                        <li class="breadcrumb-item text-primary-color" aria-current="page">
                            Contact Us
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- #banner end -->

    <!-- Contact Form Section -->
    <section class="quotes-section py-5">
        <div class="container py-5 px-2 px-md-0">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-xl-10">
                    <h6 class="text-primary-color fw-semibold mb-2">
                        {{ $contents['get_in_touch']['small_heading'] ?? 'GET A QUOTE' }}
                    </h6>
                    <h2 class="font-1 text-dark" style="font-weight: 800;">
                        {!! $contents['get_in_touch']['quote_title'] ?? 'Take <span class="text-primary-color">The first step</span> toward a <span class="text-primary-color">healthier</span> mind. Join us today and start your journey to <span class="text-primary-color">well-being!</span>' !!}
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-xl-10">
                    <div class="card rounded-5 shadow-lg border-0 bg-secondary-gradient overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row g-0 align-items-stretch">
                                <!-- Left Form Side -->
                                <div class="col-lg-6 col-md-12 p-4 p-lg-5">
                                    <div class="success_msg toast align-items-center w-100 shadow-none mb-3 border border-success rounded-pill my-4"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="d-flex p-2">
                                            <div class="toast-body d-flex flex-row gap-3 align-items-center text-success">
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                Your Message Successfully Send.
                                            </div>
                                            <button type="button"
                                                class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-success"
                                                data-bs-dismiss="toast" aria-label="Close"><i
                                                    class="bi bi-x-lg"></i></button>
                                        </div>
                                    </div>
                                    <div class="error_msg toast align-items-center w-100 shadow-none border-danger mb-3 my-4 border rounded-pill"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="d-flex p-2">
                                            <div class="toast-body d-flex flex-row gap-3 align-items-center text-danger">
                                                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                                                Something Wrong ! Send Form Failed.
                                            </div>
                                            <button type="button"
                                                class="me-2 m-auto bg-transparent border-0 ps-1 pe-0 text-danger"
                                                data-bs-dismiss="toast" aria-label="Close"><i
                                                    class="bi bi-x-lg"></i></button>
                                        </div>
                                    </div>

                                    <form id="appointmentForm" class="needs-validation" novalidate>
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="name" class="form-label font-1 fs-4 fw-bold">Name</label>
                                                <input type="text" class="form-control form-control-lg rounded-5" id="name"
                                                    placeholder="Your name here" name="name" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="email" class="form-label font-1 fs-4 fw-bold">Email</label>
                                                <input type="email" class="form-control form-control-lg rounded-5"
                                                    id="email" placeholder="Your email here" name="email" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="phone" class="form-label font-1 fs-4 fw-bold">Phone</label>
                                                <input type="number" class="form-control form-control-lg rounded-5"
                                                    id="phone" placeholder="Your phone number" name="phone" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="date" class="form-label font-1 fs-4 fw-bold">Date</label>
                                                <input type="date" class="form-control form-control-lg rounded-5" id="date"
                                                    name="date" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="time" class="form-label font-1 fs-4 fw-bold">Time</label>
                                                <input type="time" class="form-control form-control-lg rounded-5" id="time"
                                                    name="time" required>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="subject" class="form-label font-1 fs-4 fw-bold">Subject</label>
                                                <input type="text" class="form-control form-control-lg rounded-5"
                                                    id="subject" placeholder="Your subject." name="subject" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="message" class="form-label font-1 fs-4 fw-bold">Message</label>
                                                <textarea class="form-control form-control-lg rounded-5" id="message"
                                                    name="message" rows="5" placeholder="Tell us your story"></textarea>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary-solid w-100 py-3 rounded-5 fw-bold submit_form">Make
                                                    An Appoinment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Right Details Side -->
                                <div
                                    class="col-lg-6 col-md-12 p-4 p-lg-5 bg-white d-flex flex-column justify-content-center">
                                    <h2 class="font-1 mb-3" style="font-weight: 800;">
                                        {{ $contents['get_in_touch']['title'] ?? 'Need Any Help ? Get In Touch With Us' }}
                                    </h2>
                                    <p class="text-muted-color mb-5" style="font-size: large;">
                                        {{ $contents['get_in_touch']['description'] ?? 'Every small step counts. We’re committed to walking with you through difficult moments, encouraging progress, and nurturing your journey toward lasting mental and emotional recovery.' }}
                                    </p>

                                    <div class="d-flex flex-column gap-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle border-white bg-secondary-color flex-shrink-0 shadow-sm"
                                                style="width: 60px; height: 60px; border: 2px solid white;">
                                                <i class="bi bi-telephone-fill fs-3 text-white"></i>
                                            </div>
                                            <div>
                                                <p class="fw-bold text-primary-color mb-0">Call us anytime</p>
                                                <h5 class="fw-bold mb-0 text-dark">
                                                    {{ $contents['get_in_touch']['phone'] ?? '(555) 123-4567' }}
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle border-white bg-secondary-color flex-shrink-0 shadow-sm"
                                                style="width: 60px; height: 60px; border: 2px solid white;">
                                                <i class="bi bi-envelope-fill fs-3 text-white"></i>
                                            </div>
                                            <div>
                                                <p class="fw-bold text-primary-color mb-0">Email us</p>
                                                <div class="d-flex flex-column">
                                                    @php
                                                        $email = $contents['get_in_touch']['email'] ?? 'workplacewellbeingbyywp@gmail.com';
                                                        $founderEmail = $contents['get_in_touch']['founder_email'] ?? 'akash@yourewonderfulproject.org';
                                                        $tertiaryEmail = $contents['get_in_touch']['tertiary_email'] ?? 'info@yourewonderfulproject.org';
                                                    @endphp
                                                    <a href="mailto:{{ $email }}?cc={{ $founderEmail }},{{ $tertiaryEmail }}"
                                                        class="text-decoration-none h5 fw-bold mb-1 text-dark scale-hover-sm d-block text-break">
                                                        {{ $email }}
                                                    </a>
                                                    <a href="mailto:{{ $founderEmail }}?cc={{ $email }},{{ $tertiaryEmail }}"
                                                        class="text-decoration-none h5 fw-bold mb-0 text-dark scale-hover-sm d-block text-break">
                                                        {{ $founderEmail }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-center rounded-circle border-white bg-secondary-color flex-shrink-0 shadow-sm"
                                                style="width: 60px; height: 60px; border: 2px solid white;">
                                                <i class="bi bi-geo-alt-fill fs-3 text-white"></i>
                                            </div>
                                            <div>
                                                <p class="fw-bold text-primary-color mb-0">Our location</p>
                                                <h5 class="fw-bold mb-0 text-dark">
                                                    {!! nl2br($contents['get_in_touch']['address'] ?? '123 Serenity Lane, <br>Blissfield, CA 90210, US.') !!}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#appointmentForm').on('submit', function (e) {
                e.preventDefault();

                if (this.checkValidity()) {
                    const $form = $(this);
                    const $submitBtn = $form.find('button[type="submit"]');
                    const originalBtnText = $submitBtn.text();

                    $submitBtn.prop('disabled', true).text('Sending...');

                    const formData = {
                        _token: "{{ csrf_token() }}",
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        date: $('#date').val(),
                        time: $('#time').val(),
                        subject: $('#subject').val(),
                        message: $('#message').val()
                    };

                    // 1. Send automated background email via SMTP
                    $.ajax({
                        url: "{{ route('com.appointment.submit') }}",
                        method: "POST",
                        data: formData, // Use the formData object we created
                        success: function (response) {
                            if (response.status === 'success') {
                                // Show success message
                                if ($('.success_msg').length) {
                                    $('.success_msg').addClass('show').css('display', 'block'); // Force show if BS toast fails
                                    const toastEl = $('.success_msg')[0];
                                    if (typeof bootstrap !== 'undefined') {
                                        const toast = new bootstrap.Toast(toastEl);
                                        toast.show();
                                    }
                                }

                                // Reset the form
                                $form[0].reset();
                                $form.removeClass('was-validated');

                                $submitBtn.prop('disabled', false).text('Message Sent!');
                                setTimeout(() => {
                                    $submitBtn.text(originalBtnText);
                                }, 3000);

                            } else {
                                $submitBtn.prop('disabled', false).text(originalBtnText);
                                // Show error toast if available
                                if ($('.error_msg').length) {
                                    $('.error_msg').addClass('show').css('display', 'block');
                                    if (typeof bootstrap !== 'undefined') {
                                        const toast = new bootstrap.Toast($('.error_msg')[0]);
                                        toast.show();
                                    }
                                } else {
                                    alert('Error: ' + response.message);
                                }
                            }
                        },
                        error: function (xhr) {
                            console.error(xhr);
                            $submitBtn.prop('disabled', false).text(originalBtnText);
                            alert('An error occurred while sending the message. Please try again later.');
                        }
                    });
                }
                $(this).addClass('was-validated');
            });
        });
    </script>
@endpush