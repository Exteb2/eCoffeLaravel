<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $json = Storage::get('produits.json');
        $products = collect(json_decode($json, true)['products']);
        $cart = session('panierProduits', []);
        
        return view('panier', compact('products', 'cart'));
    }

    public function add(Request $request)
    {
        $id = $request->input('id');
        // Initialise à 0 si la clé n'existe pas, puis incrémente
        $currentQty = session("panierProduits.$id", 0);
        session(["panierProduits.$id" => $currentQty + 1]);
        
        return redirect()->route('catalog');
    }

    public function increment(Request $request)
    {
        $id = $request->input('id');
        $currentQty = session("panierProduits.$id", 0);
        session(["panierProduits.$id" => $currentQty + 1]);
        
        return redirect()->route('cart');
    }

    // Remplace reductionProd1.php
    public function decrement(Request $request)
    {
        $id = $request->input('id');
        $currentQty = session("panierProduits.$id", 0);
        
        if ($currentQty > 0) {
            session(["panierProduits.$id" => $currentQty - 1]);
        }
        
        return redirect()->route('cart');
    }

    // Remplace supprimerPanier.php
    public function clear()
    {
        // Supprime le panier de la session
        session()->forget('panierProduits');
        return redirect()->route('catalog');
    }

    // Remplace payerPanier.php (Affichage du récapitulatif)
    public function checkout()
    {
        $json = file_get_contents(storage_path('app/private/produits.json'));
        $products = collect(json_decode($json, true)['products']);
        $cart = session('panierProduits', []);
        
        return view('payer', compact('products', 'cart'));
    }

    // Remplace verificationPayer.php (Traitement de la carte)
    public function processPayment(Request $request)
    {
        $code = $request->input('code');
        $a = substr($code, 0, 2);
        $b = substr($code, 14, 2);

        // La logique originale vérifiait strcmp($a, $b) != true (soit == 0)
        if (strcmp($a, $b) === 0) {
            session()->forget('panierProduits');
            $success = true;
        } else {
            $success = false;
        }

        return view('payment_result', compact('success'));
    }
}