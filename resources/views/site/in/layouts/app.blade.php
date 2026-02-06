<!DOCTYPE html>
<html>

<head>
    <title>IN SITE</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
        }

        header,
        footer {
            background: #27ae60;
            color: #fff;
            padding: 20px;
        }

        main {
            padding: 40px;
        }
    </style>
</head>

<body>

    <header>
        <h1>.IN HEADER</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>.IN FOOTER</p>
    </footer>

</body>

</html>