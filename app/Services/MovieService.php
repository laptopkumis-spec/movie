<?php

namespace App\Services;

use App\Interfaces\MovieRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MovieService
{
    protected $movieRepository;
    protected $categoryRepository;

    public function __construct(
        MovieRepositoryInterface $movieRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->movieRepository = $movieRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Pengambilan data movie untuk homepage dengan fitur search dan pagination
     *
     * @param string|null $search
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForHomepage($search = null)
    {
        return $this->movieRepository->getMoviesForHomepage($search);
    }

    /**
     * Pengambilan data movie untuk halaman admin dengan pagination
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMoviesForAdmin($perPage = 10)
    {
        return $this->movieRepository->getMoviesForAdmin($perPage);
    }

    /**
     * Pengambilan detail movie berdasarkan ID
     *
     * @param string $id
     * @return \App\Models\Movie|null
     */
    public function getMovieDetail($id)
    {
        return $this->movieRepository->getMovieById($id);
    }

    /**
     * Pengambilan semua kategori
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * Penyimpanan kategori baru
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function createCategory($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    /**
     * Penyimpanan movie baru dengan cover
     *
     * @param array $data
     * @return \App\Models\Movie
     */
    public function storeMovie($data)
    {
        // Generate nama file cover yang unik
        $fileName = $this->saveCoverFile($data['foto_sampul']);

        // Persiapkan data untuk disimpan
        $movieData = [
            'id' => $data['id'],
            'judul' => $data['judul'],
            'category_id' => $data['category_id'],
            'sinopsis' => $data['sinopsis'],
            'tahun' => $data['tahun'],
            'pemain' => $data['pemain'],
            'foto_sampul' => $fileName,
        ];

        // Simpan data movie ke database melalui repository
        return $this->movieRepository->createMovie($movieData);
    }

    /**
     * Update movie dengan kemampuan update cover
     *
     * @param string $id
     * @param array $data
     * @return \App\Models\Movie
     */
    public function updateMovie($id, $data)
    {
        // Ambil movie dari database
        $movie = $this->movieRepository->getMovieById($id);

        // Jika ada file cover baru
        if (isset($data['foto_sampul']) && $data['foto_sampul']) {
            // Simpan cover baru
            $fileName = $this->saveCoverFile($data['foto_sampul']);

            // Hapus cover lama
            $this->deleteOldCover($movie->foto_sampul);

            $data['foto_sampul'] = $fileName;
        } else {
            // Jika tidak ada cover baru, hapus key dari data
            unset($data['foto_sampul']);
        }

        // Update data movie melalui repository
        return $this->movieRepository->updateMovie($id, $data);
    }

    /**
     * Hapus movie dan cover-nya
     *
     * @param string $id
     * @return bool
     */
    public function deleteMovie($id)
    {
        // Ambil movie dari database
        $movie = $this->movieRepository->getMovieById($id);

        // Hapus cover
        $this->deleteOldCover($movie->foto_sampul);

        // Hapus record dari database melalui repository
        return $this->movieRepository->deleteMovie($id);
    }

    /**
     * Simpan file cover ke folder public/images
     *
     * @param object $file
     * @return string
     */
    private function saveCoverFile($file)
    {
        $randomName = Str::uuid()->toString();
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = $randomName . '.' . $fileExtension;

        $file->move(public_path('images'), $fileName);

        return $fileName;
    }

    /**
     * Hapus cover lama dari folder public/images
     *
     * @param string $fileName
     * @return void
     */
    private function deleteOldCover($fileName)
    {
        $filePath = public_path('images/' . $fileName);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
