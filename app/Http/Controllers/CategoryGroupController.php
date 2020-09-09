<?php

namespace App\Http\Controllers;

use App\Models\CategoryGroup;
use App\Models\Maker;
use Illuminate\Http\Request;

class CategoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.category_group.index')
            ->with('groups',CategoryGroup::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makers = Maker::get();
        return view('admin.pages.category_group.create', compact('makers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new CategoryGroup();
        $category->uuid = uniqid('CG', false);
        $category->name = $request->input('name');
        $category->type = $request->input('type');
        $category->maker_id = $request->input('maker_id');
        $category->details = $request->input('details');
        $category->active = true;
        $category->save();

        return redirect(route('category_group.index'))->withMessage('New Category Group Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryGroup  $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryGroup $categoryGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryGroup  $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $group = CategoryGroup::where('uuid',$uuid)->where('active', true)->first();
        return view('admin.pages.category_group.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryGroup  $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $cat = CategoryGroup::where('uuid', $uuid)->first();
        if(!empty($cat)){
            $cat->update($request->all());
            return back()->withMessage('Update Successful');
        }

        return back()->withErrors(array('error'=>'Not Found'));
    }

    public function pop($uuid){
        $category = CategoryGroup::where('uuid', $uuid)->first();
        $msg = "Category Group - $category->name Deleted";
        $category->delete();
        return redirect()->route('category.index')->withMessage($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryGroup  $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryGroup $categoryGroup)
    {
        //
    }
}
