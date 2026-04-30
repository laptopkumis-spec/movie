<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    /**
     * Pengambilan data movie untuk homepage dengan fitur search dan pagination
     *
     * @param string|null $search
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForHomepage($search = null, $perPage = 6);

    /**
     * Pengambilan data movie untuk halaman admin dengan pagination
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForAdmin($perPage = 10);

    /**
     * Pengambilan detail movie berdasarkan ID
     *
     * @param string $id
     * @return \App\Models\Movie|null
     */
    public function getMovieById($id);

    /**
     * Penyimpanan movie baru ke database
     *
     * @param array $data
     * @return \App\Models\Movie
     */
    public function createMovie($data);

    /**
     * Update movie di database
     *
     * @param string $id
     * @param array $data
     * @return \App\Models\Movie
     */
    public function updateMovie($id, $data);

    /**
     * Hapus movie dari database
     *
     * @param string $id
     * @return bool
     */
    public function deleteMovie($id);
}
