<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Informazioni Applicazione</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .card {
            margin-bottom: 20px;
        }

        /* Stampa */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }

            .card {
                border: 1px solid #000;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <!-- Pulsante stampa -->
    <div class="text-end mb-3 no-print">
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Stampa
        </button>
    </div>

    <h2 class="mb-4">Informazioni Applicazione</h2>

    <!-- Info generali -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Generali
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nome App</th>
                    <td>{{ config('app.name') }}</td>
                </tr>
                <tr>
                    <th>Ambiente</th>
                    <td>{{ app()->environment() }}</td>
                </tr>
                <tr>
                    <th>URL</th>
                    <td>{{ config('app.url') }}</td>
                </tr>
                <tr>
                    <th>Timezone</th>
                    <td>{{ config('app.timezone') }}</td>
                </tr>
                <tr>
                    <th>Locale</th>
                    <td>{{ config('app.locale') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Sistema -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Sistema
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>PHP Version</th>
                    <td>{{ phpversion() }}</td>
                </tr>
                <tr>
                    <th>Laravel Version</th>
                    <td>{{ app()->version() }}</td>
                </tr>
                <tr>
                    <th>Server</th>
                    <td>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'N/D' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Database -->
    <div class="card">
        <div class="card-header bg-info text-white">
            Database
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Connessione</th>
                    <td>{{ config('database.default') }}</td>
                </tr>
                <tr>
                    <th>Host</th>
                    <td>{{ config('database.connections.' . config('database.default') . '.host') }}</td>
                </tr>
                <tr>
                    <th>Database</th>
                    <td>{{ config('database.connections.' . config('database.default') . '.database') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Data -->
    <div class="card">
        <div class="card-header bg-success text-white">
            Data e Ora
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Ora corrente</th>
                    <td>{{ now() }}</td>
                </tr>
                <tr>
                    <th>Ora UTC</th>
                    <td>{{ now()->setTimezone('UTC') }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>

</body>
</html>