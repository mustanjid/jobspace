<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,600;1,600&display=swap"
        rel="stylesheet">
    <title>Job Space</title>
    @vite(['resources/css/app.css', 'resources/css/flowbite.min.css', 'resources/js/app.js'])
</head>

<body>
    <div class="mb-24">
        <x-nav-bar />
    </div>

    <div class="mb-16 mt-20 space-y-10">
        <main class="mx-auto max-w-[986px] space-y-10">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
