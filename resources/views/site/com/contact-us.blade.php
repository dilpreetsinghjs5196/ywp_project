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
                            {{ $contents['get_in_touch']['small_heading'] ?? 'GET A QUOTE' }}</h6>
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

                                        <form class="needs-validation" novalidate>
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
                                                        class="btn btn-primary-solid w-100 py-3 rounded-5 fw-bold submit_form">Make An Appoinment</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Right Details Side -->
                                    <div class="col-lg-6 col-md-12 p-4 p-lg-5 bg-white d-flex flex-column justify-content-center">
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
                                                    <h5 class="fw-bold mb-0 text-dark">{{ $contents['get_in_touch']['phone'] ?? '(555) 123-4567' }}</h5>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-3">
                                                <div class="d-flex align-items-center justify-content-center rounded-circle border-white bg-secondary-color flex-shrink-0 shadow-sm"
                                                    style="width: 60px; height: 60px; border: 2px solid white;">
                                                    <i class="bi bi-envelope-fill fs-3 text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="fw-bold text-primary-color mb-0">Email us</p>
                                                    <h5 class="fw-bold mb-0 text-dark">{{ $contents['get_in_touch']['email'] ?? 'Info@Yourmail.Com' }}</h5>
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