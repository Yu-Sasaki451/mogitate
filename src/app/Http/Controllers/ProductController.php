<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){

        $keyword = trim((string) $request->query('keyword', ''));
        $sort = (string) $request->query('sort', '');

        $sortMap = [
        'price_desc' => ['price', 'desc'],
        'price_asc'  => ['price', 'asc'],
        ];

        $query = Product::query();

        if ($keyword !== '') {
        $escaped = addcslashes($keyword, "\\%_");
        $query->whereRaw("name LIKE ? ESCAPE '\\\\'", ["%{$escaped}%"]);
        }

        if (isset($sortMap[$sort])) {
        [$col, $dir] = $sortMap[$sort];
        $query->orderBy($col, $dir);
        } else {
        $sort = '';
        }
        $products = $query
            ->paginate(6)
            ->appends($request->query());
        return view('index', compact('products', 'keyword', 'sort'));
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

    public function edit($id){
        $product = Product::with('seasons')->find($id);
        $seasons = Season::all();
        return view('edit',compact('product','seasons'));
    }

    public function update(Request $request, $id){
    $product = Product::findOrFail($id);

    $data = $request->only(['name', 'price', 'description']);
    $product->update($data);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
        $product->save();
    }

    $product->seasons()->sync($request->input('season_ids', []));

    return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id)->delete();

        return redirect('/products');
    }

}
