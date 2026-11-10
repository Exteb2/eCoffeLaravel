@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        @if($success)
            <h1 class="text-success mb-4">Paiement réussi</h1>
            <p>Merci pour votre achat !</p>
            <a href="{{ route('catalog') }}" class="btn btn-secondary">Retour Accueil</a>
        @else
            <h1 class="text-danger mb-4">Paiement échoué</h1>
            <p>Les informations de votre carte sont invalides.</p>
            <a href="{{ route('cart') }}" class="btn btn-secondary">Retour Panier</a>
        @endif
    </div>
@endsection