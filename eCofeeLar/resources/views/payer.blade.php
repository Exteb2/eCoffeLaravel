@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Récapitulatif</h1>

    <div class="row row-cols-3">
        @foreach($products as $product)
            @if(isset($cart[$product['id']]) && $cart[$product['id']] > 0)
                <div class="col mb-4">
                    <div class="card p-3 text-center">
                        <h5>{{ $product['name'] }}</h5>
                        <img src="{{ asset('images/' . basename($product['image_url'])) }}" class="card-img-top w-50 mx-auto" alt="">
                        <p class="text-success fw-bold mt-2">{{ $product['price'] }} €</p>
                        <p>Quantité : <strong>{{ $cart[$product['id']] }}</strong></p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @php
        $total = 0;
        foreach($products as $product) {
            if(isset($cart[$product['id']])) {
                $total += $product['price'] * $cart[$product['id']];
            }
        }
    @endphp

    <div class="mt-4">
        <h4>Total: <span class="text-success fw-bold">{{ $total }} €</span></h4>
        
        <div class="d-flex mt-4 gap-2">
            <a href="{{ route('cart') }}" class="btn btn-secondary">Retour Panier</a>
        </div>

        <form method="POST" action="{{ route('cart.processPayment') }}" class="mt-5 p-4 border rounded bg-light">
            @csrf
            <h4>Veuillez saisir les 16 chiffres de votre carte bancaire</h4>
            <div class="mb-3">
                <input type="text" name="code" class="form-control w-50" minlength="16" maxlength="16" required>
            </div>
            <button type="submit" class="btn btn-success">Payer</button>
        </form>
    </div>
@endsection