<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Pengambilan semua kategori
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * Penyimpanan kategori baru
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function createCategory($data)
    {
        return Category::create($data);
    }
}
