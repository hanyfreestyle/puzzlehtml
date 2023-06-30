<?php

namespace App\Http\Controllers\admin\config;

use App\Http\Controllers\AdminMainController;
use App\Models\admin\config\UploadFilter;
use App\Http\Requests\StoreUploadFilterRequest;
use App\Http\Requests\UpdateUploadFilterRequest;

class UploadFilterController extends AdminMainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUploadFilterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UploadFilter $uploadFilter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UploadFilter $uploadFilter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUploadFilterRequest $request, UploadFilter $uploadFilter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UploadFilter $uploadFilter)
    {
        //
    }
}
