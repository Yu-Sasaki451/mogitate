<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::Paginate(6);
        return view('index', compact('products'));
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

    public function store(Request $request){
        $products = $request->only([
            'name',
            'price',
            'description',
        ]);
        $seasonIds = $request->input('season_ids', []);

        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $products['image'] = $path;
        }

        DB::transaction(function () use ($products, $seasonIds) {
            $product = Product::create($products);
            $product->seasons()->sync($seasonIds);
        });

        return redirect ('/products');
    }

}
