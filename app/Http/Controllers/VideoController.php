<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\VideoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Middleware\CheckVerifyEmail;
use App\Http\Requests\UpdateVideoRequest;

class VideoController extends Controller
{

    public function index()
    {
        $videos = Video::all();

        return $videos;
    }

    public function create()
    {
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->create($request->user(), $request->all());
        return redirect()->route('index')->with('alert', __('messages.success'));
    }

    public function show(Request $request, Video $video)
    {
        $video->load('comments.user');
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $this->authorize('update', $video);  
        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        (new VideoService)->update( $video, $request->all());
        return redirect()->route('videos.show', $video->slug)->with('alert', __('messages.video_edited'));
    }
    
}
