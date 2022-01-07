<!DOCTYPE html>
<html>
<head>
    <title>Laporan Progres ( {{$param}} )</title>

    <style>
        h1, h2, h3, h4, h5, h6 {
            line-height: 1px;
        }

        #tabel {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          margin-top: 2rem;
          margin-left: auto;
          margin-right: auto;

        }

        #tabel td, #tabel th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #tabel, th {
            background-color: darkgrey;
            color: white;
        }

        #tabel, td {
            background-color: white;
            color: rgb(41, 40, 40);
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Data Laporan Progres ( {{$param}} )</h1>
    <table id="tabel" >
        <tr>
            <th>Tanggal</th>
            <th>User PSb</th>
            <th>Status</th>
            <th>Datek</th>
            <th>SN</th>
            <th>Jum. AP</th>
            <th>Pnj. DC</th>
            <th>Mat. Lain</th>
            <th>Ket. Tambahan</th>
        </tr>
        @if(count($data))
            @foreach ($data as $item)
                <tr >
                    <td >
                        {{ $item->tanggal }}
                    </td>
                    <td >
                        {{ $item->work_orders->user_psb }}
                    </td>
                    <td >
                        {{ $item->status }}
                    </td>
                    <td >
                        {{ $item->work_orders->datek }}
                    </td>
                    <td >
                        {{ $item->sn_modem }}
                    </td>
                    <td >
                        {{ $item->jumlah_ap }}
                    </td>
                    <td >
                        {{ $item->panjang_dc }}
                    </td>
                    <td >
                        {{ $item->material_lain }}
                    </td>
                    <td >
                        {{ $item->keterangan_tambahan }}
                    </td>
                </tr>
            @endforeach
        @endif
    </table>
</body>
</html>
