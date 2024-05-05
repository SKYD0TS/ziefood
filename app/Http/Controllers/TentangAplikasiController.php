<?php

namespace App\Http\Controllers;

use App\Models\TentangAplikasi;
use App\Http\Requests\StoreTentangAplikasiRequest;
use App\Http\Requests\UpdateTentangAplikasiRequest;

class TentangAplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tentangAplikasi.tentang');
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
     * @param  \App\Http\Requests\StoreTentangAplikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTentangAplikasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TentangAplikasi  $tentangAplikasi
     * @return \Illuminate\Http\Response
     */
    public function show(TentangAplikasi $tentangAplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TentangAplikasi  $tentangAplikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(TentangAplikasi $tentangAplikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTentangAplikasiRequest  $request
     * @param  \App\Models\TentangAplikasi  $tentangAplikasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTentangAplikasiRequest $request, TentangAplikasi $tentangAplikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TentangAplikasi  $tentangAplikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(TentangAplikasi $tentangAplikasi)
    {
        //
    }
}
