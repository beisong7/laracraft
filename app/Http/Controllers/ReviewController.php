<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $reviews = Review::class;
        if($type==='submitted'){
            $reviews = $reviews::where('active', '!=', true)->orWhere('active', null);
        }elseif ($type==='active'){
            $reviews = $reviews::where('active', true);
        }else{
            return redirect()->route('');
        }

//        return $reviews->get();

        return view('admin.pages.review.index')->with(['reviews'=>$reviews->orderBy('id', 'desc')->paginate(30)]);
        //
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

    public function toggle($uuid){
        $review = Review::where('uuid', $uuid)->first();
        if(!empty($review)){
            $msg = "";
            $state = null;
            if($review->active){
                $state = false;
                $msg = "Dropped review successfully";
            }else{
                $state = true;
                $msg = "Approved review successfully";
            }
            $review->active = $state;
            $review->update();
            return back()->withMessage($msg);
        }

        return back();
    }
}