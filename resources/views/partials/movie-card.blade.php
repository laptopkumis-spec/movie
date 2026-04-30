{{--
  Movie Card Component

  Props:
  - $movie: Movie model instance
  - $type: 'horizontal' (untuk homepage) atau 'vertical' (default)
--}}

@php
    // Memberikan default value untuk $type jika tidak didefinisikan saat include
    $layoutType = $type ?? 'vertical';
@endphp

@if ($layoutType === 'horizontal')
    {{-- Card Horizontal (Homepage) --}}
    <div class="col-lg-6">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/images/{{ $movie['foto_sampul'] }}" class="img-fluid rounded-start"
                        alt="{{ $movie['judul'] }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['judul'] }}</h5>
                        <p class="card-text">{{ $movie['sinopsis'] }}</p>
                        <a href="{{ url('/movie/' . $movie['id']) }}" class="btn btn-success">Lihat Selanjutnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Card Vertikal (Detail Page) --}}
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-3">
                <img src="/images/{{ $movie['foto_sampul'] }}" class="img-fluid rounded-start"
                    alt="{{ $movie['judul'] }}">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title">{{ $movie['judul'] }}</h2>
                    <p class="card-text">{{ $movie['sinopsis'] }}</p>
                    <p class="card-text">
                        <strong>Kategori:</strong> 
                        {{ $movie->category->nama_kategori ?? 'Tanpa Kategori' }}
                    </p>
                    <p class="card-text"><strong>Tahun:</strong> {{ $movie['tahun'] }}</p>
                    <p class="card-text"><strong>Pemain:</strong> {{ $movie['pemain'] }}</p>
                    <a href="/" class="btn btn-success">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endif
