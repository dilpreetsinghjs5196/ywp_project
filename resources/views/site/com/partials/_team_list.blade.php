@forelse($teams as $member)
  <div class="col-12 col-lg-6 mb-4" data-aos="fade-up" data-aos-easing="linear"
    data-aos-delay="{{ 100 * $loop->iteration }}" data-aos-duration="1000">
    <div
      class="therapist-brief-card h-100 bg-white rounded-4 shadow-sm border overflow-hidden d-flex flex-column flex-md-row">
      <!-- Image Section -->
      <div class="therapist-image-box position-relative">
        <img
          src="{{ Str::startsWith($member->image, 'image/') ? asset($member->image) : asset('storage/' . $member->image) }}"
          alt="{{ $member->name }}" class="w-100 h-100" style="object-fit: cover;">
        @if($member->is_active)
          <span
            class="position-absolute top-0 start-0 m-3 badge bg-success rounded-pill px-3 shadow-sm">Available</span>
        @endif
      </div>

      <!-- Content Section -->
      <div class="therapist-details-box p-4 flex-grow-1 d-flex flex-column">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div class="flex-grow-1">
            <h4 class="font-1 fw-bold mb-1 text-dark" style="line-height: 1.2 !important;">{{ $member->name }}</h4>
            <p class="text-muted mb-0 fw-medium" style="line-height: 1.4;">{{ $member->designation ?? 'Therapist' }}
            </p>
          </div>
        </div>

        <!-- Expertise Tags -->
        @php
          $specialties = $member->specialties ? explode(',', $member->specialties) : ($member->specialization ? explode(',', $member->specialization) : []);
        @endphp
        <div class="d-flex flex-wrap gap-2 mb-2">
          @foreach(array_slice($specialties, 0, 3) as $spec)
            <span class="expertise-tag">{{ trim($spec) }}</span>
          @endforeach
          @if(count($specialties) > 3)
            <span class="expertise-tag text-muted">+{{ count($specialties) - 3 }} more</span>
          @endif
        </div>

        <!-- Info List -->
        <div class="info-list mb-2">
          @if($member->services->count() > 0)
            @php
              $firstSrv = $member->services->first();
              $durationText = $firstSrv->pivot->duration ?? $settings['session_duration'] ?? '50 mins';
            @endphp
            <div class="info-item d-flex align-items-center mb-1">
              <i class="bi bi-patch-check text-primary-color me-2"></i>
              <span class="text-muted small">Services: <span
                  class="text-dark fw-medium">{{ $member->services->pluck('title')->implode(', ') }}</span></span>
            </div>
            <div class="info-item d-flex align-items-center mb-1">
              <i class="bi bi-clock text-primary-color me-2"></i>
              <span class="text-muted small">Duration: <span
                  class="text-dark fw-medium">{{ $durationText }}</span></span>
            </div>
          @endif
          @if($member->languages)
            <div class="info-item d-flex align-items-center mb-1">
              <i class="bi bi-translate text-primary-color me-2"></i>
              <span class="text-muted small">Speaks: <span
                  class="text-dark fw-medium">{{ $member->languages }}</span></span>
            </div>
          @endif
          @if($member->mode)
            <div class="info-item d-flex align-items-center mb-1">
              <i class="bi bi-geo-alt text-primary-color me-2"></i>
              <span class="text-muted small">Mode: <span class="text-dark fw-medium">{{ $member->mode }}</span></span>
            </div>
          @endif
          @if($member->office_address)
            <div class="info-item d-flex align-items-center mb-1">
              <i class="bi bi-building text-primary-color me-2"></i>
              <span class="text-muted small">Location: <span
                  class="text-dark fw-medium">{{ $member->office_address }}</span></span>
            </div>
          @endif
        </div>

        <!-- Action Section -->
        <div class="mt-auto pt-3 border-top d-flex gap-3">
          <a href="{{ route('com.team.single', $member->id) }}"
            class="btn btn-view-profile rounded-pill px-3 fw-bold py-3 text-nowrap">VIEW PROFILE</a>
          <a href="{{ route('com.therapist.booking', $member->id) }}"
            class="btn btn-book-now rounded-pill px-4 fw-bold py-3 text-white text-nowrap">BOOK NOW</a>
        </div>
      </div>
    </div>
  </div>
@empty
  <div class="col-12 text-center py-5">
    <p class="text-muted-color fs-5">No team members found.</p>
  </div>
@endforelse
