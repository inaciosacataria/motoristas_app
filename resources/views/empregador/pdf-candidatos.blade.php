<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Candidatos - {{ $anuncio->titulo ?? 'Vaga' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #04c512;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #04c512;
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
            background-color: #04c512;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>Lista de Candidatos</h1>
        <p><strong>Vaga:</strong> {{ $anuncio->titulo ?? 'N/A' }}</p>
        <p><strong>Data de Geração:</strong> {{ date('d/m/Y H:i') }}</p>
        <p><strong>Total de Candidatos:</strong> {{ count($candidaturas) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Contacto</th>
                <th>Habilitação</th>
                <th>Idade</th>
                <th>Província</th>
                <th>Grau Acadêmico</th>
                <th>Data Candidatura</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidaturas as $key => $candidato)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $candidato->name }}</td>
                <td>{{ $candidato->celular }}</td>
                <td>{{ $candidato->categoria }}</td>
                <td>{{ \Carbon\Carbon::parse($candidato->datanascimento)->age }} anos</td>
                <td>{{ $candidato->provincia }}</td>
                <td>{{ $candidato->grau_academico ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($candidato->created_at)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Gerado por Motoristas.co.mz - Sistema de Gestão de Empregos</p>
        <p>Página {PAGENO} de {nbpg}</p>
    </div>
</body>
</html>
