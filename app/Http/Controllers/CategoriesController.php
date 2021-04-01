<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $categories = Category::all();
        $category = Category::create($request->validated());

        if($category) {
            return redirect()->route('categories.index')->with([
                'success' => 'Category Added Successfully.',
                'categories' => $categories
            ]);
        } else {
            return view('admin.categories.index')->with('error', 'Error in Adding the Categoru.');
        }
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
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();

        if($category) {
            return view('admin.categories.index')->with([
                'categories' => $categories,
                'category' => $category,
            ]);
        } else {
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category) {
            $categories = Category::all();
            $category->delete();
            return redirect()->route('categories.index')->with([
                'success' => 'Category Deleted Successfully.',
                'categories' => $categories
            ]);
        } else {
            return redirect()->route('categories.index')->with('error', 'Failed in delete the category.');
        }
    }
}
