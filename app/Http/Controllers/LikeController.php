<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function like(Request $request, $slug): JsonResponse
    {
        $gallery = Gallery::whereSlug($slug)->first();

        $like = Like::where('user_id', $request->user_id)
                    ->where('gallery_id', $gallery->id)
                    ->first();

        if (!$like) {
            // Jika "like" belum ada, buat yang baru
            Like::create([
                'user_id' => $request->user_id,
                'gallery_id' => $gallery->id,
            ]);

            $likeCount = Like::where('gallery_id', $gallery->id)->count();

            return response()->json([
                "message" => "You just liked $gallery->title",
                "likeCount" => $likeCount,
                "status" => true
            ], 200);
        } else {
            $like->delete();

            $likeCount = Like::where('gallery_id', $gallery->id)->count();

            return response()->json([
                "message" => "You just unliked $gallery->title",
                "likeCount" => $likeCount,
                "status" => false
            ], 200);
        }
    }
}
