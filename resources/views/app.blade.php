<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="This is dummy description for the Application from blade"/>
    <title>{{ $page_title ?? '' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </head>
  <body>
    @inertia
  </body>
</html>
