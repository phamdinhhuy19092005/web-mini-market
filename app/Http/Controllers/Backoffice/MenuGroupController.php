<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Backoffice\BaseController;
use Illuminate\Http\Request;

class MenuGroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backoffice.pages.menu-groups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backoffice.pages.menu-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backoffice.pages.menu-groups.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backoffice.pages.menu-groups.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
