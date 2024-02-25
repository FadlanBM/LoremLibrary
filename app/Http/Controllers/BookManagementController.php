<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::all();
        $categories = Categories::all();
        return view('pages.employees.BookManagement', ['book' => $book, 'category' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'no_inventaris' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'code' => ['string', 'max:255'],
            'year_published' => 'required|numeric',
            'items' => 'required|array|min:1',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.book')->withErrors($validator)->withInput();
        }

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->no_inventaris = $request->no_inventaris;
        $book->description = $request->description;
        $book->year_published = $request->year_published;
        $book->code = $request->code;
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('sampul', $image, $imageName);
            $img_file = basename($path);
            $book->img = $img_file;
        }
        $book->save();

        $category_id = $request->input('items', []);

        foreach ($category_id as $category_id) {
            $listcategory = new BookCategory();
            $listcategory->book_id = $book->id;
            $listcategory->category_id = $category_id;
            $listcategory->save();
        }

        return back()->with('success', 'Berhasil menambahkan data buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Categories::all();
        $bookCategories = $book->categories->pluck('id')->toArray();
        return view('pages.employees.form.UpdateBuku', ['book' => $book, 'categories' => $categories, 'bookCategories' => $bookCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'no_inventaris' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'code' => ['string', 'max:255'],
            'year_published' => 'required|numeric',
            'items' => 'required|array|min:1',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.show',$id)->withErrors($validator)->withInput();
        }

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->no_inventaris = $request->no_inventaris;
        $book->description = $request->description;
        $book->year_published = $request->year_published;
        $book->code = $request->code;

        if ($request->hasFile('img')) {
            Storage::delete('sampul/' . $book->img);
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = Storage::putFileAs('sampul', $image, $imageName);
            $img_file = basename($path);
            $book->img = $img_file;
        }
        $book->save();
        $book->categories()->detach();
        $category_ids = $request->input('items', []);
        $book->categories()->attach($category_ids);

        return redirect()->route('employees.book')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        Storage::delete('sampul/' . $book->img);
        $book->categories()->detach();
        $book->delete();
        return response()->json([], 200);
    }
}
