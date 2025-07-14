{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel ToDo App</title>
    @yield('head') 
</head>
<body>
    @if (session()->has('success'))
      <div>{{ session('success') }}</div>
    @endif
    <h1>@yield('title')</h1>
    <div>
        @yield('content')
    </div>
</body>
</html>
