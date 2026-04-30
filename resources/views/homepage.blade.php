@extends('layout.template')

@section('title', 'Homepage')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Popular Movie</h1>
    <div class="row">
        @foreach ($movies as $movie)
            {{-- Include Movie Card Partial (Horizontal Layout) --}}
            @include('partials.movie-card', ['movie' => $movie, 'type' => 'horizontal'])
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
