<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;

class CategoryController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.category.index')
            ->with('categories',Category::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = CategoryGroup::where('active', true)->get();
        return view('admin.pages.category.create')->with('groups', $groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->uuid = uniqid('CAT', false);
        $category->name = $request->input('name');
        $category->group_id = $request->input('group_id');
        $category->details = $request->input('details');
        $category->active = true;
        $category->save();

        return redirect(route('category.index'))->withMessage('New Category Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
//        return Maker::where('uuid',$maker)->first();
        $categorz = Category::where('uuid',$category)->first();
        $groups = CategoryGroup::where('active', true)->get();
        if(!empty($categorz)){
            return view('admin.pages.category.edit')
                ->with('category', $categorz)
                ->with('groups', $groups);
        }else{
            return back()->withErrors(['error'=>'Details not found']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $cat = Category::where('uuid', $uuid)->first();
        if(!empty($cat)){
            if($cat->update($request->all())){
                return back()->withMessage('Update Successful');
            }else{
                return back()->withErrors(array('error'=>'Unable to complete'));
            }
        }else{
            return back()->withErrors(array('error'=>'Not Found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(!empty($category->products)){
            return  back()->withErrors(['errors'=>'this category has items']);
        }else{
            $category->delete();
            return redirect()->route('category.index')->withMessage('Category Deleted');
        }

    }

    public function pop($uuid){
        $category = Category::where('uuid', $uuid)->first();
        if(!empty($category->products->count()>0)){
            return  back()->withErrors(['errors'=>'this category has items. delete items before deleting']);
        }else{
            $msg = "Category $category->name Deleted";
            $category->delete();
            return redirect()->route('category.index')->withMessage($msg);
        }
    }

    public function disable(Category $category){
        if(!empty($category)){
            $data['active'] = false;
            if($category->update($data)){
                return back()->withMessage('Category Disabled!');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function enable(Category $category){
        if(!empty($category)){
            $data['active'] = true;
            if($category->update($data)){
                return back()->withMessage('Category Enabled!');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }
}
