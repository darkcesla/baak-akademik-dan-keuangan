<!DOCTYPE html>
<html lang="en">

<head>
  <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/notification.css') }}" rel="stylesheet" type="text/css" />  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Izin Bermalam Mahasiswa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: none;
    }

    table th,
    table td {
      padding: 8px;
      text-align: left;
      border: none;
    }

    table th {
    }

    table tr:nth-child(even) {
    }

    table tr:hover {
    }
  </style>
</head>

<body>
  <table border="0">
    <tr>
      <td>      
  <h1>Surat Izin Bermalam Mahasiswa</h1>
  <p>DIBERIKAN IZIN BERMALAM KEPADA:</p>
      </td>
      <td>
        <img alt="Logo" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('assets/media/logos/logo.jpeg'))) }}" />
      </td>
    </tr>
  </table>
  <table border="0">
    <tr>
      <th>Nama</th>
      <td>{{ $data['user']['nama_Lengkap'] }}</td>
    </tr>
    <tr>
      <th>Rencana IB</th>
      <td>
        <p>Tanggal Berangkat: {{ \Carbon\Carbon::parse($data['waktuBerangkat'])->format('d/m/Y H:i') }}</p>
        <p>Keperluan: {{ $data['keterangan'] }}</p>
        <p>Tanggal Kembali: {{ \Carbon\Carbon::parse($data['waktuKembali'])->format('d/m/Y H:i') }} </p>
        <p>Tujuan: {{ $data['tujuan'] }}</p>
      </td>
    </tr>
  </table>

  <p>* Sebelum meninggalkan asrama untuk IB, mahasiswa/i dianjurkan untuk permisi kepada bapak/ibu asrama atau abang/kakak asrama.</p>
  <div class="row d-flex justify-content-center">
    <div class="col-md-12">
      <table border="0">
        <thead>
          <tr>
            <th align="center">Pemohon</th>
            <th align="center">Bapak/Ibu Asrama</th>
            <th align="center">Orangtua/wali</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <br> <br> <br>
              (........................)</td>
            <td>
              <br> <br> <br>
              (........................)</td>
            <td>
              <br> <br> <br>
              (........................)</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  <hr>
  <table border="0">
    <tr>
        <h4>Realisasi IB (diisi oleh petugas)</h4> 
        <p>Tanggal kembali:</p>
        <p>Pukul:</p>
        <p>Petugas Menyetujui, petugas</p>
        <p>&nbsp;</p>
        <p>(........................)</p>

      </td>
    </tr>
  </table>
</body>

</html>
