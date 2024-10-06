<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminArticleCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category = Category::orderBy('created_at', 'ASC')->paginate(1000);
        return view('backend.modules.articles.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
         $this->validate($request, [
             'name' => 'required|string|max:50|unique:categories'
         ]);
     
         $request->request->add(['slug' => $request->name]);
     
         $existingCategory = Category::where('name', $request->name)->exists();
         if ($existingCategory) {
             return redirect()->back()->with(['error' => 'The name has already been taken.']);
         }
     
         Category::create($request->except('_token'));
         return redirect(route('categories.index'))->with(['success' => 'New category has been added!']);
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
        return response()->json([
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(Request $request, $id)
     {
         $category_id = $request->input('category_id');
     
         $this->validate($request, [
             'name' => 'required|string|max:50|unique:categories,name,' . $category_id
         ]);
     
         $category = Category::find($category_id);
     
         if (!$category) {
             return redirect(route('categories.index'))->with(['error' => 'Category not found!']);
         }
     
         $category->name = $request->name;
         $category->slug = $request->name;
         $category->save();
     
         return redirect(route('categories.index'))->with(['success' => 'The category has been updated!']);
     }
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $category = Category::withCount(['article'])->find($id);
        if ($category->article_count == 0) {
            $category->delete();
            return redirect(route('categories.index'))->with(['success' => 'The category has been removed!']);
        }
        return redirect(route('categories.index'))->with(['error' => 'Failed to delete category! This category has associated articles.']); 
    }
}