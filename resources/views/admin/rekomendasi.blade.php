@extends('layouts.main')
@section('content')
<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Search here...">
        </div>

        <img src="/images/profil.png" alt="">
    </div>
    <div class="dash-content">
        <div class="activity">
            <div class="title">
                <i class="uil uil-lightbulb-alt"></i>
                <span class="text">Rekomendasi Saham</span>
            </div>
            <a href="{{ route('rekomendasi.download') }}" class="btn btn-primary my-2">
                <i class="uil uil-file-download"></i> Download PDF
            </a>

            <table id="datatable" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Saham</th>
                        <th>Nama Saham</th>
                        <th>Nilai Z</th>
                        <th>Persentase</th>
                        <th>Kategori</th>
                        <th>Interpretasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hasil as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->saham->kode_saham ?? '-' }}</td>
                            <td>{{ $item->saham->nama_saham ?? '-' }}</td>
                            <td>{{ number_format($item->nilai_z, 2) }}</td>
                            <td>{{ number_format($item->persentase, 2) }}%</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->interpretasi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data rekomendasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
                zeroRecords: "Data tidak ditemukan",
            }
        });
    });
</script>
@endsection
