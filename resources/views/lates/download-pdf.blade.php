<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: none;
            padding: 8px;
        }

        .signature {
            text-align: center;
            margin-top: 20px;
        }

        .signature img {
            max-width: 100px;
            border: 1px solid #000;
            margin-top: 10px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            <p>SURAT PERNYATAAN</p>
            <p>TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</p>
        </div>
        <div class="content">
            <p>Yang bertanda tangan di bawah ini :</p>
            <p>NIS: {{ $lates->student->nis }}</p>
            <p>Nama: {{ $lates->student->name }}</p>
            <p>Rombel: {{ $lates->student['rombel']['rombel'] }}</p>
            <p>Rayon: {{ $lates->student['rayon']['rayon'] }}</p>
        </div>

        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke
            sekolah sebanyak <strong>3 Kali</strong> yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan.
            Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi
            saya siap diberikan sanksi yang sesuai dengan peraturan sekolah</p>
        <br>
        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan</p>

        <div class="signature">
            <table>
                <tr>
                    <td></td>
                    <td>{{ $currentTime->format('d F Y ') }}</td>
                <tr>
                    <td>Peserta Didik</td>
                    <td>Orang Tua/Wali Peserta Didik</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>__________________</td>
                    <td>__________________</td>
                </tr>
                <tr>
                    <td>{{ $lates['name'] }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pembimbing Siswa</td>
                    <td>Kesiswaan</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>__________________</td>
                    <td>__________________</td>
                </tr>
                <tr>
                    <td>PS {{ $lates['rayon'] }}</td>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>
