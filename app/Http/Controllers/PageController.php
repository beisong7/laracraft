<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(20);
        return view('admin.pages.page.index')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slug = $request->input('title');
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);

        $exist = Page::where('slug', $slug)->first();
        if(!empty($exist)){
            return back()->withErrors(['A page with this name already exist'])->withInput($request->input());
        }

        $page = new Page();
        $page->uuid = $this->generateId('PG', 30);
        $page->title = $request->input('title');
        $page->slug = $slug;
        $page->info = $request->input('info');
        $page->published = false;
        $page->save();

        return redirect()->route('page.index')->withMessage('New Page Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $page = Page::where('uuid', $uuid)->first();

        return view('admin.pages.page.edit')->with('page', $page);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $page = Page::where('uuid', $uuid)->first();

        if(empty($page)){
            return redirect()->route('page.index');
        }

        if($page->published){
            return back()->withErrors(['Unpublish page before taking this action']);
        }
        $slug = $request->input('title');
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);

        $exist = Page::where('slug', $slug)->where('uuid', '!=', $uuid)->first();

        if(!empty($exist)){
            return back()->withErrors(['A page with this name already exist']);
        }

        $page->title = $request->input('title');
        $page->slug = $slug;
        $page->info = $request->input('info');
        $page->update();

        return back()->withMessage('Page Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }


    public function unpublish($uuid){
        $page = Page::where('uuid', $uuid)->first();
        if(empty($page)){
            return back()->withMessage('Page Could Not Be Updated');
        }
        $data['published'] = false;
        if(Auth::user()->who >= 3){
            if($page->update($data)){
                return back()->withMessage('Page Un-Published');
            }else{
                return back()->withMessage('Page Could Not Be Un-Published');
            }
        }else{
            return back()->withMessage('Page Could Not Be Updated');
        }

    }

    public function publish($uuid){

        $page = Page::where('uuid', $uuid)->first();
        if(empty($page)){
            return back()->withMessage('Page Could Not Be Updated');
        }

        $data['published'] = true;
        if(Auth::user()->who >= 3){
            if($page->update($data)){
                return back()->withMessage('Page Published');
            }else{
                return back()->withMessage('Page Could Not Be Published');
            }
        }else{
            return back()->withMessage('Page Could Not Be Published');
        }
    }

    public function seepage($slug){
        $page = Page::where('slug', $slug)->first();

        if(!empty($page)){
            if($page->published){
                return view('pages.blank.page')->with('page', $page);
            }
        }
        return redirect()->route('home');
    }
}
