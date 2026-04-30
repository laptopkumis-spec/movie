<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * Pengambilan data movie untuk homepage dengan fitur search dan pagination
     *
     * @param string|null $search
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForHomepage($search = null, $perPage = 6)
    {
        $query = Movie::with('category')->latest();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('sinopsis', 'like', '%' . $search . '%');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Pengambilan data movie untuk halaman admin dengan pagination
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForAdmin($perPage = 10)
    {
        return Movie::with('category')->latest()->paginate($perPage);
    }

    /**
     * Pengambilan detail movie berdasarkan ID
     *
     * @param string $id
     * @return \App\Models\Movie|null
     */
    public function getMovieById($id)
    {
        return Movie::with('category')->find($id);
    }

    /**
     * Penyimpanan movie baru ke database
     *
     * @param array $data
     * @return \App\Models\Movie
     */
    public function createMovie($data)
    {
        return Movie::create($data);
    }

    /**
     * Update movie di database
     *
     * @param string $id
     * @param array $data
     * @return \App\Models\Movie
     */
    public function updateMovie($id, $data)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($data);
        return $movie;
    }

    /**
     * Hapus movie dari database
     *
     * @param string $id
     * @return bool
     */
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return $movie->delete();
    }
}
