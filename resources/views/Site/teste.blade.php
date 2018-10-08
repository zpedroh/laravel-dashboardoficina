<!DOCTYPE html>
<html lang="en">
<head>

    <title>Demo</title>
    <!-- include sweetalert2 css library -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.css">

</head>
<body>
    <H1>Homepage</h1>

    <form action="/justapage" method="post">
        {{ csrf_field() }}
        <button type="submit">Click me!</button>
    </form>

    <!-- include sweetalert2 js library. Note: place it in the body, not in the head -->
    <script src="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.js"></script>

    <!-- And is where Laravel and javascript come together -->
    <!-- This include basically writes the neccessary javascript: -->
    @include('Alerts::alerts')

</body>
</html>