<!DOCTYPE html>
<html>

<head>
    <title>Data UMKM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Data UMKM</h1>
    <table>
        <tr>
            <th>Nama Pemilik UMKM</th>
            <td>{{ $ukm->user->name }}</td>
        </tr>
        <tr>
            <th>Nomor NIK Pemilik UMKM</th>
            <td>{{ $ukm->user->identity_number }}</td>
        </tr>
        <tr>
            <th>Nama UMKM</th>
            <td>{{ $ukm->ukm_name }}</td>
        </tr>
        <tr>
            <th>Alamat UMKM</th>
            <td>{{ $ukm->ukm_address }}</td>
        </tr>
        <tr>
            <th>WhatsApp PIC</th>
            <td>{{ $ukm->wa_pic }}</td>
        </tr>
        <tr>
            <th>Email UMKM</th>
            <td>{{ $ukm->ukm_email }}</td>
        </tr>
        <tr>
            <th>Password Sementara</th>
            <td>{{ $ukm->user->temp_password }}</td>
    </table>
</body>

</html>