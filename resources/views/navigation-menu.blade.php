<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
<link rel="stylesheet" href="{{ asset('css/styles_navbar.css') }}">
<body>
    <header id="header">
        <ul>
            <li><a href="/users">Usuaris</a></li>
            <li><a href="/incidences">Incidències</a></li>
            <li><a href="/zones">Zones</a></li>
            <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </li>
            <li><a href="/user/profile">Perfil</a></li>
        </ul>
    </header>
</body>
</nav>

