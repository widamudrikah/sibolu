<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Surat Pengusulan</title>
    <style>
        body {
            height: 842px;
            width: 595px;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }

        .header img {
            width: 75px;
            display: inline;
            float: left;
        }

        .header {
            text-align: center;
            margin-top: 10px;
            position: relative;
        }

        .textheader {
            display: inline;
            margin-top: 100px;
            text-align: center;
        }

        .headerAddress {
            display: inline-block;
            margin-bottom: 0px;
            margin-top: 0px;
            text-align: left;
        }

        .headingTitle {
            display: inline;
        }

        .title {
            text-align: center;
        }

        .legalitor {
            float: right;
        }

        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            position: relative;
        }

        .d-flex {
            display: flex;
            flex-direction: row;
            justify-content: center;
            justify-content: space-between;
        }
        td{
            text-align: center;
        }
    </style>
    <script>
        function prints() {

            document.getElementById('btnPrint').style.display = "none";
            window.print();
            window.onafterprint = show();
        }

        function back() {
            window.location = 'report';
        }

        function show() {
            document.getElementById('btnBack').style.display = "inline";
            document.getElementById('btnPrint').style.display = "inline";
        }
        
    </script>
</head>

<button id="btnPrint" onclick="prints()" class="button">Print</button>

<body>
    <div class="d-flex">
        <img src="{{ asset('gentella/production/images/bolu.png') }}" alt="Logo Institusi" height="100px" />
        <h1>Sibolu</h1><br>
    </div>
    <span style="border: solid 0.5px; width: 100%; display: flex"></span>
    <span style="border: solid 1.5px; width: 99.8%; display: flex; margin-top:2px"></span>

    <div class="title" style="margin-top: 20px">
        <u>
            <h1 class="headingTitle">LAPORAN BULANAN</h1>
        </u>
    </div>
    <br>
    <p align="justify">
        @foreach ($transactions as $data)
            Laporan Data Bulan {{ $data->created_at->format('F') }}
        @endforeach
    </p>

    <br>
    <div>
        <table border="1" width="550px" cellpadding="4" cellspacing="0">
            <tr>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Ongkir</th>
                <th>Total</th>
                <th>Metode</th>
            </tr>
            @foreach ($transactions as $dt)
                <tr>
                    <td>#{{ $dt->kode }}</td>
                    <td>
                        @php
                            $rakyat = App\Models\Masyarakat::find($dt->masyarakat_id);
                            $user = App\Models\User::find($rakyat->user_id);
                            $masyarakat = $user->nama;
                        @endphp
                        {{ $masyarakat }}
                    </td>
                    <td>Rp{{ number_format($dt->harga) }}</td>
                    <td>{{ $dt->jumlah }}</td>
                    <td>
                        <?php
                        if ($dt->ongkir == 0){
                            $kota = 'Pangkep';                            
                        }elseif ($dt->ongkir == 50000){
                            $kota = 'Maros';    
                        }else {
                            $kota = 'Makassar';    
                        }  
                        ?>                        
                        {{$kota}} <br>
                        Rp{{ number_format($dt->ongkir) }}
                    </td>
                    <td>Rp{{ number_format($dt->harga_total) }}</td>
                    <td>
                        @php
                            if ($dt->pembayaran == 'cod') {
                                $bayar = 'COD';
                            } else {
                                $bayar = 'TRANSFER';
                            }
                        @endphp
                        {{ $bayar }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>
</body>

</html>
