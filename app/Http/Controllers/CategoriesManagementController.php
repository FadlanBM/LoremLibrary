<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CategoriesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('pages.employees.CategoriesBook', ['categories' => $categories]);
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
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.categories')->withErrors($validator)->withInput();
        }

        $kategory = new Categories();
        $kategory->name = $request->name;
        $kategory->save();

        return redirect()->route('employees.categories')->with('success', 'Berhasil menambahkan kategory');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategory = categories::find($id);

        return response()->json($kategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.categories')->withErrors($validator)->withInput();
        }

        $categories = Categories::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();
        return response()->json(
            [
                'message' => 'SUCCESS',
            ],
            200,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategory = Categories::findOrFail($id);
        $kategory->delete();
        return response()->json([
            'message' => 'SUCCESS',
        ]);
    }
}
