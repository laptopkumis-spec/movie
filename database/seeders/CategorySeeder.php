<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Action', 'keterangan' => 'Film dengan adegan aksi dan pertarungan'],
            ['nama_kategori' => 'Komedi', 'keterangan' => 'Film yang bertujuan menghibur dan membuat tertawa'],
            ['nama_kategori' => 'Romance', 'keterangan' => 'Film tentang kisah cinta dan hubungan romantis'],
            ['nama_kategori' => 'Horror', 'keterangan' => 'Film yang dirancang untuk menakuti penonton'],
            ['nama_kategori' => 'Drama', 'keterangan' => 'Film yang berfokus pada perkembangan karakter dan emosi'],
            ['nama_kategori' => 'Animasi', 'keterangan' => 'Film kartun atau gambar bergerak'],
            ['nama_kategori' => 'Petualangan', 'keterangan' => 'Film tentang perjalanan dan penjelajahan'],
            ['nama_kategori' => 'Sains Fiksi', 'keterangan' => 'Film tentang konsep masa depan atau teknologi canggih'],
            ['nama_kategori' => 'Fantasi', 'keterangan' => 'Film dengan elemen sihir atau dunia khayalan'],
            ['nama_kategori' => 'Thriller', 'keterangan' => 'Film yang menegangkan dan penuh teka-teki'],
            ['nama_kategori' => 'Misteri', 'keterangan' => 'Film tentang pemecahan masalah atau rahasia'],
            ['nama_kategori' => 'Dokumenter', 'keterangan' => 'Film berdasarkan fakta atau kejadian nyata'],
            ['nama_kategori' => 'Kriminal', 'keterangan' => 'Film tentang kejahatan dan penegakan hukum'],
            ['nama_kategori' => 'Perang', 'keterangan' => 'Film bertemakan konflik militer dan sejarah perang'],
            ['nama_kategori' => 'Western', 'keterangan' => 'Film bertemakan kehidupan di Amerika Barat (koboi)'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['nama_kategori' => $category['nama_kategori']], $category);
        }
    }
}
