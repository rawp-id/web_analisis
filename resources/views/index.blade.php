<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Analisis</title>
    <link rel="icon" href="globe.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body data-bs-theme="dark">
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <span class="navbar-brand mb-0 h1"><img src="globe.png" alt="logo" class="img" width="8%"> Web
                Analisis</span>
        </div>
    </nav>
    <div class="container mt-4">
        <form method="GET" class="text-center">
            <h1>Website Analisis</h1>
            <div class="input-group mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Inputkan Link Website" name="url"
                    value="{{ request('url', '') }}">
                <button class="btn btn-outline-secondary" type="submit">Analisis</button>
            </div>
        </form>
        <div class="text-center spinner-container" id="loadingSpinner">
            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @if ($result)
            <hr class="mt-4">
            <div class="mt-4">
                <h1>Hasil Analisis dari URL: {{ $url }}</h1>
                <h2 class="mt-3">SEO Data</h2>
                <p><strong>Title:</strong> {{ $seoData['title'] }}</p>
                <p><strong>Description:</strong> {{ $seoData['description'] }}</p>
                <p><strong>Header Tags:</strong></p>
                <ul>
                    @foreach ($seoData['h1Tags'] as $tag)
                        <li>{{ $tag }}</li>
                    @endforeach
                </ul>
                <p><strong>Kategori: </strong> {{ $classification }}</p>

                <h2 class="mt-3">Favicon</h2>
                <img src="{{ $favicon }}" class="img-thumbnail" alt="Favicon">

                <h2 class="mt-3">Logo</h2>
                @if ($logo)
                    <img src="{{ $logo }}" class="img-thumbnail" alt="Logo">
                @else
                    <p><strong class="text-danger">Logo Not Found</strong></p>
                @endif

                <h2 class="mt-3">PageSpeed Insights</h2>
                @if ($pageSpeedResults)
                    <table class="table table-bordered">
                        <tr>
                            <th>Metric</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>Performance Score</td>
                            <td
                                class="{{ $pageSpeedResults['lighthouseResult']['categories']['performance']['score'] < 0.5 ? 'text-danger' : ($pageSpeedResults['lighthouseResult']['categories']['performance']['score'] < 0.9 ? 'text-warning' : 'text-success') }}">
                                {{ number_format($pageSpeedResults['lighthouseResult']['categories']['performance']['score'] * 100, 0) }}%
                            </td>
                        </tr>
                        <tr>
                            <td>First Contentful Paint</td>
                            <td>{{ $pageSpeedResults['lighthouseResult']['audits']['first-contentful-paint']['displayValue'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Speed Index</td>
                            <td>{{ $pageSpeedResults['lighthouseResult']['audits']['speed-index']['displayValue'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Time to Interactive</td>
                            <td>{{ $pageSpeedResults['lighthouseResult']['audits']['interactive']['displayValue'] }}
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const spinner = document.querySelector('.spinner-container');
            spinner.style.display = 'none';

            document.querySelector('.content').style.display = 'block';
        });
        
        window.addEventListener('load', function() {
            const spinner = document.querySelector('.spinner-container');
            spinner.style.display = 'none';

            document.querySelector('.content').style.display = 'block';
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                document.getElementById('loadingSpinner').style.display =
                    'block';
            });
        });
        window.onload = function() {
            document.getElementById('loadingSpinner').style.display = 'none';
        }
    </script>
</body>

</html>
