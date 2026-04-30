@extends('layout.template')

@section('title', $movie['judul'])

@section('content')

    {{-- Include Movie Card Partial (Default Layout) --}}
    @include('partials.movie-card', ['movie' => $movie])

@endsection
