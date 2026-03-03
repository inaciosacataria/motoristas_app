<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Motoristas - Motoristas.co.mz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #059669;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #059669;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #059669;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lista de Motoristas</h1>
        <p><strong>Data de Geração:</strong> {{ date('d/m/Y H:i') }}</p>
        <p><strong>Total de Motoristas:</strong> {{ count($motoristas) }}</p>
        <p class="no-print" style="margin-top: 15px;">
            <button onclick="window.print(); return false;" style="background:#059669; color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-size:14px;">
                🖨️ Imprimir esta lista
            </button>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Categoria / Habilitação</th>
                <th>Grau Académico</th>
                <th>Província</th>
                <th>Contacto</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motoristas as $index => $motorista)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $motorista->name ?? 'N/A' }}</td>
                <td>{{ $motorista->categoria ?? 'N/A' }}</td>
                <td>{{ $motorista->grau_academico ?? 'N/A' }}</td>
                <td>{{ $motorista->provincia ?? 'N/A' }}</td>
                <td>{{ $motorista->celular ?? 'N/A' }}</td>
                <td>{{ $motorista->email ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Gerado por Motoristas.co.mz - Sistema de Gestão de Empregos</p>
        <p>{{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
