<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.blog_category.index')
            ->with('contents', Content::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $exist = Content::where('name', $name)->first();
        if(empty($exist)){
            $content = new Content();
            $content->name = $name;
            $content->info = $request->input('info');
            $content->active = true;
            $content->save();
            return redirect()->route('content.index')->withMessage('New Category added');
        }

        return back()->withErrors(['error'=>'Name already Used'])->withInput($request->input());
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        if(!empty($content)){
            return view('admin.pages.blog_category.edit')->with('content', $content);
        }
        return back()->withErrors(['error'=>'Not found']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $name = $request->input('name');

        if($content->name !== $name){
            $exist = Content::where('name', $name)->first();
            if(!empty($exist)){
                return back()->withErrors(['error'=>'Name already Used'])->withInput($request->input());
            }
        }

        $content->name = $name;
        $content->info = $request->input('info');
        $content->update();
        return back()->withMessage('Category Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
