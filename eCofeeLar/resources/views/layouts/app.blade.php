<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Coff-E-Shop</title>
    <!-- Utilisation du CDN pour Bootstrap dans ce modèle -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a { text-decoration: none; color: white; }
        a:hover { transform: scale(1.1); }
        .navbar-custom { display: flex; justify-content: space-between; background: #222; padding: 20px; color: white; }
    </style>
</head>
<body>
    @if(session('connecte'))
    <nav class="navbar-custom">
        <a href="{{ route('catalog') }}">Accueil</a>
        <a href="{{ route('cart') }}">Panier</a>
        <a href="{{ route('logout') }}">Se déconnecter</a>
    </nav>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>