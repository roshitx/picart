<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gallery = Gallery::orderBy('created_at', 'DESC')->paginate(10);

        abort_if($gallery->isEmpty(), 204);

        return view('index', [
            'gallery' => $gallery,
        ]);
    }
}
