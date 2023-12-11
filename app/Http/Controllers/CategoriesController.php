<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Rules\SlugRule;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_list = Categories::with('children')->whereNull('parent_id')->get();
        $categories = Categories::all();
        return view('admin.categories.index', compact('categories', 'category_list'));
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:2',
            'slug' => ['required', 'string', 'min:2', new SlugRule(Categories::class)],
        ]);

    

        // if validates fields
        // create array and store data
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->filled('parent_id') ? $request->parent_id : NULL,
            'description' => $request->filled('description') ? $request->description : NULL
        ];

         
        $add = Categories::create($data);
        if($add)
        {
            return to_route('all.categories')->with('message', 'Added Successfully' );
        }else{
            return to_route('all.categories')->with('message', 'Error..!' );
        }
        
        
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Categories::findOrFail($id);
        $categories = Categories::all();
        return view('admin.categories.edit', compact('categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Categories::findOrFail($id);
        $request->validate([
            'title' => 'required|string|min:2',
            'slug' => ['required', 'string', 'min:2', new SlugRule(Categories::class, 'slug', $data->id)],
        ]);

        // create array and store data
      
        $data->title = $request->title;
        $data->slug = $request->slug;
        $data->parent_id = $request->filled('parent_id') ? $request->parent_id : NULL;
        $data->description = $request->filled('description') ? $request->description : NULL;
        $data->save();

        return to_route('all.categories')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        $message = [
            'message' => 'Category information moved to trash',
            'type' => 'success',
            'icon' => ''
        ];
        return response()->json($message);
    }
}
