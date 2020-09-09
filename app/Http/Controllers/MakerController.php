<?php

namespace App\Http\Controllers;


use App\Models\Maker;
use Illuminate\Http\Request;

class MakerController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.maker.index')
            ->with('makers', Maker::paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.maker.create');
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
        $exist = Maker::where('name', $name)->first();
        if(empty($exist)){

            if(!empty($name)){

                $maker = new Maker();
                $maker->name = $name;
                $maker->uuid = $this->generateId('MKR', 27);
                $maker->phone = $request->input('phone');
                $maker->active = true;
                $maker->save();
                return redirect()->route('maker.index')->withMessage('New Manufacturer Created.');
            }

            return back()->withErrors(array('error'=>'Missing name field.'));

        }

        return back()->withErrors(['error'=>"Manufacturer with the name $name already exist"]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function show(Maker $maker)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function edit($maker)
    {
//        return Maker::where('uuid',$maker)->first();
        $mfr = Maker::where('uuid',$maker)->first();
        if(!empty($mfr)){
            return view('admin.pages.maker.edit')->with('maker', $mfr);
        }

        return back()->withErrors(['error'=>'Not found']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maker  $maker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maker)
    {
        $mfr = Maker::find($maker);
        if(!empty($mfr)){
            if($mfr->update($request->all())){
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
    public function destroy(Maker $maker)
    {

    }

    public function disable(Maker $maker){
        if(!empty($maker)){
            $data['active'] = false;
            if($maker->update($data)){
                return back()->withMessage('Manufacturer Disabled');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }

    public function enable(Maker $maker){
        if(!empty($maker)){
            $data['active'] = true;
            if($maker->update($data)){
                return back()->withMessage('Manufacturer Enabled');
            }else{
                return back()->withErrors(array('error'=>'unable to complete.'));
            }
        }else{
            return back();
        }
    }
}
