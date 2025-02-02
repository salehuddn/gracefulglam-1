<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());
   
        return redirect()->route('categories.index')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = $category->products;

        return view('categories.show', compact('category', 'products'));    
    }
    
    public function display(Category $category)
    {
        return view('categories.display', compact('category'));    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required',
        ]);
    
        $category->update([
            'category_name' => $request->category_name,
        ]);
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
  
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }
}
