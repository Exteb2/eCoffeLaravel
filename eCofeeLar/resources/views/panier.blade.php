@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Votre Panier</h2>

    @php
        $totalItems = 0;
        foreach($cart as $qty) {
            if($qty > 0) $totalItems++;
        }
    @endphp

    @if($totalItems == 0)
        <div class="alert alert-info">Votre panier est vide.</div>
    @else
        <div class="row row-cols-3">
            @foreach($products as $product)
                @if(isset($cart[$product['id']]) && $cart[$product['id']] > 0)
                    <div class="col mb-4">
                        <div class="card h-100 p-3 text-center">
                            <h5>{{ $product['name'] }}</h5>
                            <a href="{{ route('details', ['id' => $product['id']]) }}">
                                <img src="{{ asset('images/' . basename($product['image_url'])) }}" class="card-img-top w-75 mx-auto" alt="">
                            </a>
                            <p class="text-success fw-bold mt-2">{{ $product['price'] }} €</p>
                            
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <form method="POST" action="{{ route('cart.dec') }}" class="me-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">-1</button>
                                </form>

                                <span class="fw-bold px-3">{{ $cart[$product['id']] }}</span>

                                <form method="POST" action="{{ route('cart.inc') }}" class="ms-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                                    <button type="submit" class="btn btn-sm btn-outline-success">+1</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @php
            $totalPrice = 0;
            foreach($products as $product) {
                if(isset($cart[$product['id']])) {
                    $totalPrice += $product['price'] * $cart[$product['id']];
                }
            }
        @endphp

        <div class="mt-4 p-4 bg-light rounded text-end">
            <h4>Total: <span class="text-success fw-bold">{{ number_format($totalPrice, 2) }} €</span></h4>
            <div class="mt-3">
                <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger me-2">Vider le Panier</button>
                </form>
                <!-- Remplacez l'action par la route vers payerPanier si vous avez créé la vue et le contrôleur pour le paiement -->
                <button class="btn btn-success">Payer</button>
            </div>
        </div>
    @endif
@endsection