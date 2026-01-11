<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;

class ProductController extends Controller
{
    public function showIndex(){
        return view('index');
    }

    public function create()
{
    $subDir = 'fruits-img';
    $dir = public_path("img/{$subDir}");
    $imageOptions = collect(\Illuminate\Support\Facades\File::files($dir))
        ->map(fn($f) => $f->getFilename())
        ->filter(fn($name) => preg_match('/\.(png|jpe?g|gif|webp)$/i', $name))
        ->values()
        ->all();

    $seasons = Season::orderBy('id')->get()->all();

    return view('store', compact('imageOptions','subDir','seasons'));
}

}
