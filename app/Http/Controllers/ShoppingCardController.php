<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoppingCardRequest;
use App\Http\Requests\UpdateShoppingCardRequest;
use App\Models\ShoppingCard;

class ShoppingCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Http\Requests\StoreShoppingCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCard  $shoppingCard
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCard $shoppingCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCard  $shoppingCard
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCard $shoppingCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShoppingCardRequest  $request
     * @param  \App\Models\ShoppingCard  $shoppingCard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingCardRequest $request, ShoppingCard $shoppingCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCard  $shoppingCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCard $shoppingCard)
    {
        //
    }
}
