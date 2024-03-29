<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::with('area')->get();
        $areas = Area::with('products')->get();
        $cities = City::with('products')->get();
        $sizes = Size::with('products')->get();

        return response()-> view ('dashboard.media.billboards.index', [
            'products'=>Product::all(),
            'title' => 'Daftar Billboard',
            compact('products', 'areas', 'cities', 'sizes')
        ]);
    }

    public function showProduct(){
        $dataProduct = Product::All();

        return response()->json(['dataProduct'=> $dataProduct]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response
    {
        dd($product->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // dd($product->product_category->name);
        if($product->photo){
            Storage::delete($product->photo);
        }

        Product::destroy($product->id);

        if ($product->category === 'Billboard'){
            return redirect('/dashboard/media/billboards')->with('success','Billboard dengan kode ' . $product->code . ' berhasil dihapus');
        }
    }
}
