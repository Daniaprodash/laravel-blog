<!DOCTYPE html>
<html lang="ar" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    
</head>

<body>

<div class="main-wrapper d-flex flex-column min-vh-100">
    
    @include('partial.navbar')

    <main class="flex-grow-1">
      @yield('content')
    </main>

    @include('partial.footer')

  </div>

  @include('partial.scripts')
  @yield('scripts')

</body>
</html>