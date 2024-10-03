<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Post</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
            border-width: 5ch;
            border-color: black;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .header2 img {
            width: 50px;
            height: auto;
            border-radius: 5px;
        }
        .header img {
            width: 150px;
            height: auto;

        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-top: 10px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #2d3748;
        }
        th, td {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #2d3748;
        }
        .content {
            font-size: 16px;
            color: #4a5568;
            line-height: 1.5;
            text-align: center;
            justify-content: center;
            border-radius: 8px;
            padding: 20px;
        }
        .firma-seccion {
            margin-top: 50px;
            text-align: center;
            font-size: 16px;
            color: #2d3748;
        }
        .firma-seccion p {
            margin-bottom: 80px;
        }
        .firma-linea {
            margin-top: 30px;
            margin: auto;
            border-top: 1px solid #2d3748;
            width: 200px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #a0aec0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('/assets/cfe.png') }}" alt="Logo" class="logo">
        </div>

        <table style="margin-top: 100px">
            <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>ID del Post</th>
                <th>Autor</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th>Fecha de Creación</th>
            </tr>
            <tr>
                <td>{{ $post->tittle }}</td>
                <td class="header2">
                @if($post->image)
                    <img src="{{ public_path(''.$post->image) }}" alt="Post Image">
                @else
                    <img src="{{ public_path('/assets/ImageNotFound.png') }}" alt="Default Image">
                @endif
                </td>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user->rpe }}</td>
                <td>{{ $post->getLikesCount() }}</td>
                <td>{{ $post->getDislikesCount() }}</td>
                <td>{{ $post->created_at }}</td>
            </tr>
        </table>

        <div class="content">
            <h2>Contenido del Post</h2>
            <p>{{ $post->content }}</p>
        </div>

        <div class="firma-seccion">
            <p>Firma del Autor:</p>
            <div class="firma-linea"></div>
            <p>{{ $post->user->rpe }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Generado por CFE</p>
        </div>
    </div>
</body>
</html>
