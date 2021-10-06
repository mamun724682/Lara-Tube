<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChannelRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth')->only('update');
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('channel.show', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Channel $channel
     * @return \Illuminate\Http\Response
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        if ($request->hasFile('image')){
            $channel->clearMediaCollection('images');
            $channel->addMediaFromRequest('image')->toMediaCollection('images');
        }

        $channel->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
