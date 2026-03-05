<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'JobPilot') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* === STYLE GLOBAL JOBPILOT === */
        body {
            font-family: 'Roboto', 'Segoe UI', sans-serif;
            background-color:rgb(0, 0, 0);
            color: #eaeaea;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(90deg, #121212, #1c1c1c);
            color: #fff;
            padding: 18px 0;
            text-align: center;
            border-bottom: 1px solid #222;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline-block;
            margin-right: 25px;
        }

        header nav ul li a {
            color: #f1f1f1;
            text-decoration: none;
            font-size: 17px;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
            position: relative;
        }

        header nav ul li a::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #00bcd4;
            transition: width 0.3s ease;
        }

        header nav ul li a:hover {
            color: #00bcd4;
            transform: translateY(-2px);
        }

        header nav ul li a:hover::after {
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
            font-size: 2.2rem;
            letter-spacing: 1px;
        }

        .container {
            background-color:black;
            width: 85%;
            margin: 0 auto;
            padding: 40px 0;
        }

        .container-show {
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        footer {
            background-color: #111;
            color: #bbb;
            text-align: center;
            padding: 25px 0;
            border-top: 1px solid #222;
            margin-top: 60px;
            font-size: 14px;
        }

        /* === CARTES === */
        .card, .OffreCard, .EntrepriseCard, .CandidatCard {
            background-color: #1b1b1b;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card {
            border-radius: 12px;
            padding: 35px;
            max-width: 600px;
            width: 100%;
        }

        .card:hover, .OffreCard:hover, .EntrepriseCard:hover, .CandidatCard:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.5);
        }

        .OffreCard h3, .EntrepriseCard h3, .CandidatCard h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #fff;
        }

        .OffreCard strong, .EntrepriseCard strong, .CandidatCard strong {
            color: #00bcd4;
            font-weight: 600;
        }

        .OffreCard p, .EntrepriseCard p, .CandidatCard p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #ccc;
        }

        .liste_offres, .liste_entreprises, .liste_candidats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 25px;
            margin-top: 25px;
        }

        /* === TITRES & DÉTAILS === */
        .h1-show, .h1-show-entreprise, .h1-show-candidat {
            font-size: 1.8rem;
            color: #f1f1f1;
            margin-bottom: 20px;
            padding-left: 12px;
            border-left: 5px solid;
        }

        .h1-show { border-color: #00bcd4; }
        .h1-show-entreprise { border-color: #4caf50; }
        .h1-show-candidat { border-color: #f44336; }

        .info {
            margin-bottom: 15px;
            font-size: 15px;
            line-height: 1.5;
        }

        .info strong {
            color: #00bcd4;
            font-weight: 600;
        }

        .description {
            line-height: 1.6;
            color: #ccc;
        }

        .description strong {
            color: #00bcd4;
        }

        /* === BADGES === */
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-cdi { background-color: #4caf50; }
        .badge-cdd { background-color: #ff9800; }
        .badge-stage { background-color: #2196f3; }
        .badge-alternance { background-color: #9c27b0; }
        .badge-freelance { background-color: #f44336;}

        /* === BOUTONS === */
        .btn-create {
            display: inline-block;
            color: #00bcd4;
            text-decoration: none;
            font-weight: 600;
            border: 2px solid #00bcd4;
            padding: 10px 18px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-create:hover {
            color: #fff;
            background-color: #00bcd4;
        }

        .icon-link {
            color: #00bcd4;
            font-size: 18px;
            text-decoration: none;
            transition: transform 0.2s, opacity 0.2s;
        }

        .icon-link.delete { color: #f44336; }

        .icon-link:hover {
            transform: scale(1.2);
            opacity: 0.85;
        }

        .voir-offre, .voir-entreprise, .voir-candidat {
            color: #4caf50;
            font-weight: bold;
            text-decoration: none;
            font-size: 22px;
            transition: opacity 0.3s;
        }

        .voir-offre:hover, .voir-entreprise:hover, .voir-candidat:hover {
            opacity: 0.8;
        }

        /* === FORMULAIRES === */
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #00bcd4;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form input[type="email"],
        form input[type="password"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #333;
            border-radius: 8px;
            background-color: #121212;
            color: #f1f1f1;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        form select {
            height: 42px;
            line-height: 1.2;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(2);
            transform: scale(1.6);
            cursor: pointer;
            margin-right: 6px;
        }

        form input:focus,
        form select:focus,
        form textarea:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 6px rgba(0,188,212,0.5);
            outline: none;
        }

        form button[type="submit"],
        form button[type="button"] {
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        form button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
        }

        form button[type="submit"]:hover {
            background-color: #43a047;
            transform: translateY(-2px);
        }

        form button[type="button"] {
            background-color: #f44336;
            color: #fff;
        }

        form button[type="button"]:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .error-message {
            background-color: #f44336;
            color: #fff;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div>
        <header>
            <nav>
                <ul>
                    @php $role = Auth::user()->role ?? 'candidat'; @endphp

                    @if($role === 'admin')
                        <li><a href="/offres">Offres</a></li>
                        <li><a href="/entreprises">Entreprises</a></li>
                        <li><a href="/candidats">Candidats</a></li>
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/dashboard">Dashboard</a></li>

                    @elseif($role === 'entreprise')
                        <li><a href="/offres">Mes Offres</a></li>
                        <li><a href="/candidats">Mes Candidatures</a></li>
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/dashboard">Dashboard</a></li>

                    @else {{-- candidat --}}
                        <li><a href="/offres">Offres</a></li>
                        <li><a href="/entreprises">Entreprises</a></li>
                        <li><a href="/profile">Profil</a></li>
                        <li><a href="/dashboard">Dashboard</a></li>
                    @endif

                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:#fff; cursor:pointer; font-weight:bold;">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="container">
            @yield('content')
        </main>

        <footer>
            <p>&copy; 2025 JobPilot, Tous droits réservés</p>
        </footer>
    </div>
</body>
</html>
