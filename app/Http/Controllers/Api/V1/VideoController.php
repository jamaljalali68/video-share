<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;

class VideoController extends Controller
{


    public function show(Video $video)
    {
        return new VideoResource($video);
    }


    public function index()
    {
        return VideoResource::collection(Video::paginate());
    }



    public function store(StoreVideoRequest $request)
    {

        (new VideoService)->create(auth()->user(), $request->all());

        return response()->json([

            'message' => 'video created ',

        ] ,201);

    }

    public function update(UpdateVideoRequest $request , Video $video)
    {

       
        $this->authorize('update' , $video);
        (new VideoService)->update($video, $request->all());

        return response()->json([
            'message' => 'video updated ',
        ] , 200);

    }

    public function destroy(Video $video)
    {

        $video->delete();

        return response()->json([
            'message' => 'video deleted ',
        ] , 200);

    }

}
