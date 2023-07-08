<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', [
            'title' => 'Rental Buku | Category',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', [
            'title'      => 'Rental Buku | Add Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'  => 'required|max:100|unique:categories',
        ]);

        Category::create($validateData);

        return redirect('/categories')->with('success', 'Categories successfully add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $title = 'Rental Buku | Edit';

        return view('categories.edit', [
            'title'     => $title,
            'category'  => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = ['name', 'slug'];

        if ($request->name != $category->name) {
            $rules['name'] = 'required|unique:categories|max:100';
        }

        $validateData = $request->validate($rules);
        $category->slug = $validateData['name'];

        Category::where('id', $category->id)
            ->update($validateData);

        return redirect('/categories')->with('success', 'Categories successfully edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/categories')->with('success', 'Category Has Been Delete!');
    }
}
