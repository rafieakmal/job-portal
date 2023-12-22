<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="csrf-token" value="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="/assets/img/logo/svg/logo-black.svg">

  <meta name="description" content="Marketing Research Indonesia Job Portal, Marketing Research Indonesia has exciting career opportunities for professionals, graduates, and interns. Here, you can uncover the work you're most passionate about.">
</head>

<body>
  <div id="app">
    <app></app>
  </div>

  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>