<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $reviews = Review::with('user')->get();
        return view('reviews.index', compact('reviews'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review = new Review;
        $review->title = $request->title;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->user_id = auth()->user()->id;
        $review->save();

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::with('user')->findOrFail($id);
        return view('reviews.show', compact('review'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
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
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review = Review::findOrFail($id);
        $review->title = $request->title;
        $review->content = $request->content;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
    
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
    
}