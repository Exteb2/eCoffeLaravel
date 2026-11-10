@extends('layouts.app')

@section('content')
    <h1>Coff-E-Shop</h1>
    <div class="row row-cols-3">
        @foreach($products as $product)
            <div class="col mb-4">
                <div class="card h-100 p-3">
                    <h5>{{ $product['name'] }}</h5>
                    <a href="{{ route('details', ['id' => $product['id']]) }}">
                        <img src="{{ asset($product['image_url']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                    </a>
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <button type="submit" class="btn btn-primary w-100">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection