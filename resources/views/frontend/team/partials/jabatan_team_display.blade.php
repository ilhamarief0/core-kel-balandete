{{-- Tampilkan anggota tim untuk jabatan saat ini --}}
@if ($jabatan->members->count() > 0)
    {{-- <div class="col-12 {{ 'indent-level-' . $level }}">
        @if ($level == 0)
            <h4 class="position-title">{{ $jabatan->name }}</h4>
        @elseif ($level == 1)
            <h5 class="position-title">{{ $jabatan->name }}</h5>
        @else
            <h6 class="position-title">{{ $jabatan->name }}</h6>
        @endif
    </div> --}}
    @foreach ($jabatan->members as $member)
      <div class="col-lg-4 col-md-6 {{ 'indent-level-' . $level }}">
          <div class="single-team-inner text-center">
              <div class="thumb team-member-image">
                  <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                  @if ($member->instagram || $member->facebook || $member->x)
                  <ul class="team-social-inner">
                      @if ($member->instagram)
                          <li><a href="{{ $member->instagram }}"><i class="fab fa-instagram"></i></a></li>
                      @endif
                      @if ($member->facebook)
                          <li><a href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                      @endif
                      @if ($member->x)
                          <li><a href="{{ $member->x }}"><i class="fab fa-x-twitter"></i></a></li>
                      @endif
                  </ul>
                  @endif
              </div>
              <div class="details">
                  <h5><a href="#">{{ $member->name }}</a></h5>
                  <p>{{ $jabatan->name }}</p> {{-- Menampilkan nama jabatan --}}
              </div>
          </div>
      </div>
    @endforeach
@endif

{{-- Secara rekursif tampilkan jabatan anak dan anggotanya --}}
@if ($jabatan->children->count() > 0)
    {{-- Indentasi untuk children akan ditambahkan oleh kelas CSS di sini --}}
    <div class="col-12">
        <div class="row">
            @foreach ($jabatan->children as $childJabatan)
                @include('frontend.team.partials.jabatan_team_display', ['jabatan' => $childJabatan, 'level' => $level + 1])
            @endforeach
        </div>
    </div>
@endif

