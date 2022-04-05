<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <livewire:styles/>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{$title}}</title>
    <link rel="stylesheet" href="/css/trix.css">
    <script src="/js/trix.js"></script>
    @yield('head')
</head>
<body>
    @yield('content')
    <livewire:scripts/>
</body>
</html>
