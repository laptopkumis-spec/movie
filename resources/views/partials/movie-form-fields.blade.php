{{--
  Movie Form Fields Component

  Props:
  - $movie: Movie model instance (nullable, untuk form baru tidak perlu)
  - $categories: Koleksi kategori
  - $isEdit: Boolean untuk menentukan apakah form edit atau baru
--}}

@if ($isEdit ?? false)
    {{-- Form Edit: ID Disabled --}}
    <div class="mb-3">
        <label for="id" class="form-label">ID Film:</label>
        <input type="text" class="form-control" id="id" name="id" value="{{ $movie->id }}" disabled>
    </div>
@else
    {{-- Form Baru: ID Enabled --}}
    <div class="mb-3">
        <label for="id" class="form-label">ID Film:</label>
        <input type="text" class="form-control" id="id" name="id" value="{{ old('id') }}" required>
    </div>
@endif

<div class="mb-3">
    <label for="judul" class="form-label">Judul:</label>
    <input type="text" class="form-control" id="judul" name="judul" value="{{ $movie->judul ?? old('judul') }}"
        required>
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">Kategori:</label>
    <select name="category_id" id="category_id" class="form-select" required>
        <option value="">Pilih Kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ ($movie->category_id ?? old('category_id')) == $category->id ? 'selected' : '' }}>
                {{ $category->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="sinopsis" class="form-label">Sinopsis:</label>
    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="4" required>{{ $movie->sinopsis ?? old('sinopsis') }}</textarea>
</div>

<div class="mb-3">
    <label for="tahun" class="form-label">Tahun:</label>
    <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $movie->tahun ?? old('tahun') }}"
        required>
</div>

<div class="mb-3">
    <label for="pemain" class="form-label">Pemain:</label>
    <input type="text" class="form-control" id="pemain" name="pemain"
        value="{{ $movie->pemain ?? old('pemain') }}" required>
</div>

@if ($isEdit ?? false)
    {{-- Form Edit: Tampilkan foto sebelumnya --}}
    <div class="mb-3">
        <label for="foto" class="form-label">Foto Sebelumnya:</label>
        <img src="/images/{{ $movie->foto_sampul }}" class="img-thumbnail" alt="{{ $movie->judul }}" width="100px">
    </div>

    <div class="mb-3">
        <label for="foto_sampul" class="form-label">Foto Sampul (Opsional):</label>
        <input type="file" class="form-control" id="foto_sampul" name="foto_sampul">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
    </div>
@else
    {{-- Form Baru: Foto required --}}
    <div class="mb-3">
        <label for="foto_sampul" class="form-label">Foto Sampul:</label>
        <input type="file" class="form-control" id="foto_sampul" name="foto_sampul" required>
    </div>
@endif

<div class="mb-3">
    <button type="submit" class="btn btn-primary">
        {{ $isEdit ?? false ? 'Simpan Perubahan' : 'Simpan' }}
    </button>
</div>
