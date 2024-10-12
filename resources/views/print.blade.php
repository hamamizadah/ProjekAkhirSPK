<!DOCTYPE html>
<html>
<head>
    <title>Print Hasil Akhir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Vertically center items */
            justify-content: center; /* Center items horizontally */
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid black; /* Bottom border for header */
        }
        .header img {
            width: 100px; /* Set width for logos */
            height: auto;
            margin-right: 20px; /* Add space between logo and text */
        }
        .header-text {
            text-align: center;
        }
        .header-text p, .header-text h1, .header-text h2 {
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="assets/img/smk.png" alt="Left Logo">
        <div class="header-text">
            <p>Data Hasil Akhir Rekomendasi Jurusan</p>
            <h1>SMK Widyagama Malang</h1>
            <p>Jl. Borobudur No.12, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142. NPSN : 20559083.</p>
            <p>Telepon: (0341) 473500, Email: smkwidyagama@gmail.com, Website: smkwidyagama.sch.id</p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                @foreach ($jurusan as $item)
                    <th>{{ $item->jurusan_kode }}</th>
                @endforeach
                <th>Minat</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($siswa as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->siswa_nama }}</td>
                    @php
                        $nilai1 = null;
                        $nilai2 = null;
                        $nilai3 = null;
                    @endphp
                    @foreach ($hasilAkhir as $hasil)
                        @if ($hasil->siswa_id == $item->siswa_id)
                            @php
                                if (is_null($nilai1)) {
                                    $nilai1 = $hasil->hasil_akhir_nilai;
                                } elseif (is_null($nilai2)) {
                                    $nilai2 = $hasil->hasil_akhir_nilai;
                                } else {
                                    $nilai3 = $hasil->hasil_akhir_nilai;
                                }
                            @endphp
                            <td>{{ $hasil->hasil_akhir_nilai }} </td>
                        @endif
                    @endforeach
                    @if(isset($minat[$i-1]))
                        <td>{{ $minat[$i-1] }}</td>
                    @else
                        <td>-</td>
                    @endif
                    @php
                        if ($nilai1 > $nilai2 && $nilai1 > $nilai3) {
                            $rekomendasi = 'TKJ';
                        } elseif ($nilai2 > $nilai1 && $nilai2 > $nilai3) {
                            $rekomendasi = 'RPL';
                        } elseif ($nilai3 > $nilai1 && $nilai3 > $nilai2) {
                            $rekomendasi = 'TSM';
                        } else {
                            $rekomendasi = isset($minat[$i-1]) ? $minat[$i-1] : '-'; 
                        }
                    @endphp
                    <td>{{ $rekomendasi }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>&copy; 2024 SMK Widyagama Malang. All rights reserved.</p>
    </div>
    
</body>
</html>
