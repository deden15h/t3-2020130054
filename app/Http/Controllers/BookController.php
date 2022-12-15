<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
        return view('image');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id' => 'required|integer|min:13',
            'judul' => 'required|max:20',
            'halaman' => 'required|integer',
            'kategori' => 'required|max:20',
            'penerbit' => 'required|max:100',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ];

        $validated = $request->validate($rules);

        $newBook = new Book();
        $newBook->id = $validated['id'];
        $newBook->judul = $validated['judul'];
        $newBook->halaman = $validated['halaman'];
        $newBook->kategori = $validated['kategori'];
        $newBook->penerbit = $validated['penerbit'];

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/images');
        $newBook->name = $name;
        $newBook->path = $path;
        $newBook->save();


        $request->session()->flash('success', "Buku yang berjudul {$validated['judul']} sudah disimpan");
        return redirect('upload-image')->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // $rules = [
        //     'id' => 'required|integer|min:13',
        //     'judul' => 'required|max:20',
        //     'halaman' => 'required|integer',
        //     'kategori' => 'required|max:20',
        //     'penerbit' => 'required|max:100'
        // ];

        // $validate = $request->validate($rules);
        // $request->session()->flash('success', "Berhasil memperbaharui data buku {$validate['judul']}.");
        // return redirect()->route('books.index');

        $validateData = $request->validate(
            [
                'id' => 'required|integer|min:13',
                'judul' => 'required|max:20',
                'halaman' => 'required|integer',
                'kategori' => 'required|max:20',
                'penerbit' => 'required|max:100'
            ]
        );
        $book->update($validateData);
        $request->session()->flash('success', "Berhasil memperbaharui data buku {$validateData['judul']}!");
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', "Data buku {$book['judul']} sudah dihapus.");
    }
}
