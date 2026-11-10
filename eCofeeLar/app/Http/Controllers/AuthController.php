<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        // Si déjà connecté, on le renvoie directement sur le catalogue
        if (session('connecte')) {
            return redirect()->route('catalog');
        }
        return view('index'); 
    }

    public function login(Request $request)
    {
        $id = $request->input('id');
        $mdp = $request->input('pw');

        if ($id === 'papi' && $mdp === 'papi') {
            // Création de la session
            session(['connecte' => true]);
            return redirect()->route('catalog');
        }

        // Retour à la page de connexion avec un message d'erreur
        return back()->with('error', 'Mot de passe incorrect');
    }

    public function logout()
    {
        session()->forget('connecte'); // Détruit la variable de session
        return redirect()->route('login');
    }
}