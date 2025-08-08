<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 700px;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            padding: 8px;
            font-size: 14px;
        }

        .isi {
            padding: 2px;
            font-size: 12px;
            text-align: center;
        }

        .head-isi {
            padding: 2px;
            font-size: 12px;
            text-align: center;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 14px;
            text-align: center;
        }

        .table-bordered thead {
            background-color: #f3f3f3;
        }

        span {
            font-size: 13px;
        }

        .badan {
            font-weight: bold;
            font-size: 33px;
        }

        .prov {
            font-weight: bold;
            font-size: 20px;
        }

        .kop img {
            width: 100px;
        }

        .addr {
            font-size: 12px;
            color: #555;
        }

        .footer {
            font-size: 10px;
            margin-top: 20px;
        }

        ol {
            padding-left: 1.5em;
        }
    </style>
</head>

<body>

    <table>
        <tr style="border-bottom: 3px solid black;">
            <td width="23%" style="text-align: center;">
                <img width="150" src="{{ public_path('ban.svg') }}" alt="Logo" class="kop">
            </td>
            <td style="color: #078ddb">
                <span class="badan">BADAN AKREDITASI NASIONAL</span><br>
                <span>PENDIDIKAN ANAK USIA DINI, PENDIDIKAN DASAR, DAN PENDIDIKAN MENENGAH</span><br>
                <span class="prov">PROVINSI JAWA TIMUR</span><br>
                {{-- <span>BBPMP Provinsi Jawa Timur, Gedung RA. Kartini Lantai 4</span><br> --}}
                <p class="addr">Jl. Ketintang Wiyata No. 15 Surabaya, 60231, Email : jatim@ban-pdm.id, Web :
                    banpdmjatim.id</p>
            </td>
        </tr>
    </table>
