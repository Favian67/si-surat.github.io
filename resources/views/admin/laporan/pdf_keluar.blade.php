<h3>Laporan Surat Keluar</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>No</th><th>Nomor Surat</th><th>Penerima</th><th>Perihal</th><th>Tanggal</th>
    </tr>
    @foreach($suratKeluar as $i => $s)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $s->nomor_surat }}</td>
        <td>{{ $s->penerima }}</td>
        <td>{{ $s->perihal->judul }}</td>
        <td>{{ $s->tanggal_surat }}</td>
    </tr>
    @endforeach
</table>
