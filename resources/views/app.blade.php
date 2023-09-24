<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>Nuevo</title>
    
</head>
<body>

    <header class="max-w-5xl m-auto p-5">
        <nav class="w-full flex flex-row justify-between items-center">
            <span class="font-bold text-2xl font-mono">The Rick and Morty API</span>
            <ul class="flex flex-row justify-end gap-5">
                <li class="">
                    <a href="/" class="text-lg font-bold font-mono text-slate-800 hover:underline hover:text-slate-700">Search</a>
                </li>
                <li>
                    <a href="/favorites" class="text-lg font-bold font-mono text-slate-800 hover:underline hover:text-slate-700">Favorites</a>
                </li>
            </ul>
            
        </nav>
    </header>
    
    <main class="max-w-5xl mx-auto px-5 pb-5">
        
        @yield('content')

    </main>

</body>
</html>