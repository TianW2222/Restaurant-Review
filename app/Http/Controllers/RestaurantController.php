<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        // dd($restaurants);
        $sort = request()->query('sort');
        
        if ($sort === "best"){
            $restaurants = $restaurants->sortByDesc(function ($restaurant) {
                return $restaurant->reviews->avg('rating');
            });
        } else {
            $restaurants = $restaurants->sortByDesc('created_at');
        }

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'location' => 'required',
            'image' => 'required|mimes:jpeg,png',
        ]);

        $imagePath = $request['image']->store('uploads', 'public');

        $data['image'] = $imagePath;
        
        auth()->user()->restaurants()->create($data);
        
        return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $sort = request()->query('sort');
        switch ($sort) {
            case('old'): $field = 'created_at'; $order = 'asc'; break;
            case('best'): $field = 'rating'; $order = 'desc'; break;
            case('worst'): $field = 'rating'; $order = 'asc'; break;
            default: $field = 'created_at'; $order = 'desc';
        };
        $reviews = $restaurant->reviews()->with('user')->orderBy($field, $order)->paginate(5);

        return view('restaurants.show', compact('restaurant', 'reviews', 'sort'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
