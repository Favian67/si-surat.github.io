<h2 style="text-align:center;">Laporan Surat - {{ $user->name }}</h2>

<h3>Surat Masuk</h3>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Pengirim</th>
            <th>Perihal</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suratMasuk as $i => $sm)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $sm->nomor_surat }}</td>
            <td>{{ $sm->pengirim }}</td>
            <td>{{ $sm->perihal->judul ?? '-' }}</td>
            <td>{{ $sm->tanggal_surat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Surat Keluar</h3>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Penerima</th>
            <th>Perihal</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suratKeluar as $i => $sk)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $sk->nomor_surat }}</td>
            <td>{{ $sk->penerima }}</td>
            <td>{{ $sk->perihal->judul ?? '-' }}</td>
            <td>{{ $sk->tanggal_surat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
