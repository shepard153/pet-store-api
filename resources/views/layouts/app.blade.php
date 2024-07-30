<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

  <!-- Styles -->
  @vite('resources/css/app.css')
</head>
<body class="container mx-auto font-sans antialiased">
@if ($errors->any())
  <div class="p-4 text-white bg-red-400 border-red-500">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (session('message'))
  <div class="p-4 text-white bg-sky-400 border-sky-500">
    {{ session('message') }}
  </div>
@endif

{{ $slot }}

</body>
</html>
