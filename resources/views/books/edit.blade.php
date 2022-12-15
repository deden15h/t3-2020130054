@extends('layouts.master')

@section('title', 'Edit Book')

@section('content')

    <h2>Update New Movie</h2>
    <form actionaction="{{ route('books.update', ['book' => $book->id]) }}" method="POST">
        @method('PATCH')
        @csrf

        <div class="col-md-6 mb-3"> <label for="id">ID</label> <input type="number"
                class="form-control @error('id') is-invalid @enderror" name="id" id="id"
                value="{{ old('id') ?? $book->id }}"> @error('id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3"> <label for="judul">judul</label> <input type="text"
                class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul"
                value="{{ old('judul') ?? $book->judul }}"> @error('judul')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3"> <label for="halaman">Halaman</label> <input type="number"
                class="form-control @error('halaman') is-invalid @enderror" name="halaman" id="halaman"
                value="{{ old('halaman') ?? $book->halaman }}"> @error('halaman')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3"> <label for="kategori">Kategori</label> <input type="text"
                class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori"
                value="{{ old('kategori') ?? $book->kategori }}"> @error('kategori')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3"> <label for="penerbit">Penerbit</label> <input type="text"
                class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" id="penerbit"
                value="{{ old('penerbit') ?? $book->penerbit }}"> @error('penerbit')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
</form> @endsection
