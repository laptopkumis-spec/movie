<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Pengambilan semua kategori
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories();

    /**
     * Penyimpanan kategori baru
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function createCategory($data);
}
