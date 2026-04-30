<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Menampilkan halaman homepage dengan data movie
     */
    public function index()
    {
        $search = request('search');
        $movies = $this->movieService->getMoviesForHomepage($search);
        return view('homepage', compact('movies'));
    }

    /**
     * Menampilkan detail movie
     */
    public function detail($id)
    {
        $movie = $this->movieService->getMovieDetail($id);
        return view('detail', compact('movie'));
    }

    /**
     * Menampilkan form create movie
     */
    public function create()
    {
        $categories = $this->movieService->getAllCategories();
        return view('input', compact('categories'));
    }

    /**
     * Menyimpan movie baru ke database
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255', Rule::unique('movies', 'id')],
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->movieService->storeMovie($validator->validated());

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Menampilkan halaman data admin dengan list movie
     */
    public function data()
    {
        $movies = $this->movieService->getMoviesForAdmin();
        return view('data-movies', compact('movies'));
    }

    /**
     * Menampilkan form edit movie
     */
    public function form_edit($id)
    {
        $movie = $this->movieService->getMovieDetail($id);
        $categories = $this->movieService->getAllCategories();
        return view('form-edit', compact('movie', 'categories'));
    }

    /**
     * Update movie di database
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'pemain' => 'required|string',
            'foto_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect("/movies/edit/{$id}")
                ->withErrors($validator)
                ->withInput();
        }

        $this->movieService->updateMovie($id, $validator->validated());

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Menghapus movie dari database
     */
    public function delete($id)
    {
        $this->movieService->deleteMovie($id);

        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Menyimpan kategori baru ke database
     */
    public function store_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $category = $this->movieService->createCategory($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ]);
    }
}
