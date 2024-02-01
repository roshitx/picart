<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Gallery;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
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
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|max:20|string',
                'description' => 'string|nullable|max:200',
                'image' => 'image|required|mimes:png,jpg,jpeg|max:3072'
            ]);

            $user = Auth::user();
            $filename = $request->file('image')->getClientOriginalName();
            $imageName = $user->username . '_' . Carbon::now()->timestamp . '.' . $filename;
            $request->file('image')->storeAs('gallery', $imageName, 'public');

            Gallery::create([
                'title' => $validate['title'],
                'description' => $validate['description'],
                'image' => $imageName,
                'user_id' => $user->id,
            ]);

            return redirect()->back()->with('success', "Success uploaded a new post!");
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('fail', "Please check image size / title length!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $gallery = Gallery::whereSlug($slug)->first();
        $user = $gallery->user;
        $post_count = $user->galleries->count();

        $av = new Avatar();

        $avatar = $av->create($user->fullname);
        if (empty($gallery)) {
            return abort(404);
        }

        return view('gallery.detail', compact('gallery', 'post_count', 'avatar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validate = $request->validate([
            'title' => 'max:20|string|required',
            'description' => 'string|nullable|max:200',
        ]);

        $gallery->update($validate);
        return redirect()->back()->with('success', 'Success updated a post!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('home')->with('success', 'Success deleted a post!');
    }
}
