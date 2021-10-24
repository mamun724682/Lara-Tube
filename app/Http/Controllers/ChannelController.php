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

    public function show(Channel $channel)
    {
        $videos = $channel->videos()->latest()->paginate();
        return view('channel.show', compact('channel', 'videos'));
    }

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
}
