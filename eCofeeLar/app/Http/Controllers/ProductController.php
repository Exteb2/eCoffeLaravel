<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private function getProducts()
    {
        $json = Storage::get('produits.json');
        return json_decode($json, true)['products'];
    }

    public function index()
    {
        $products = $this->getProducts();
        return view('ecoffe', compact('products'));
    }

    public function show($id)
    {
        $products = collect($this->getProducts());
        $product = $products->firstWhere('id', $id);

        if (!$product) {
            return redirect()->route('catalog');
        }

        return view('details', compact('product'));
    }
}