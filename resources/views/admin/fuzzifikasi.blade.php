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
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Fuzzifikasi Saham</span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table id="tabelFuzzifikasi" class="table table-hover table-striped border">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center border">No</th>
                                    <th rowspan="2" class="text-center border">Kode Saham</th>
                                    <th colspan="3" class="text-center border">PER</th>
                                    <th colspan="3" class="text-center border">ROE</th>
                                    <th colspan="3" class="text-center border">Volume</th>
                                    <th colspan="3" class="text-center border">Market Cap</th>
                                </tr>
                                <tr class="border">
                                    {{-- PER --}}
                                    <th class="text-center border">Rendah</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Tinggi</th>

                                    {{-- ROE --}}
                                    <th class="text-center border">Buruk</th>
                                    <th class="text-center border">Cukup</th>
                                    <th class="text-center border">Baik</th>

                                    {{-- Volume --}}
                                    <th class="text-center border">Kecil</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Besar</th>

                                    {{-- Market Cap --}}
                                    <th class="text-center border">Kecil</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Besar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fuzzifikasi as $data)
                                    <tr>
                                        <td class="border">{{ $loop->iteration }}</td>
                                        <td class="border">{{ optional($data->saham)->kode_saham ?? 'N/A' }}</td>

                                        {{-- PER --}}
                                        <td class="text-center border">{{ round($data->per_rendah, 3) }}</td>
                                        <td class="text-center border">{{ round($data->per_sedang, 3) }}</td>
                                        <td class="text-center border">{{ round($data->per_tinggi, 3) }}</td>

                                        {{-- ROE --}}
                                        <td class="text-center border">{{ round($data->roe_buruk, 3) }}</td>
                                        <td class="text-center border">{{ round($data->roe_cukup, 3) }}</td>
                                        <td class="text-center border">{{ round($data->roe_baik, 3) }}</td>

                                        {{-- Volume --}}
                                        <td class="text-center border">{{ round($data->volume_kecil, 3) }}</td>
                                        <td class="text-center border">{{ round($data->volume_sedang, 3) }}</td>
                                        <td class="text-center border">{{ round($data->volume_besar, 3) }}</td>

                                        {{-- Market Cap --}}
                                        <td class="text-center border">{{ round($data->kapitalis_kecil, 3) }}</td>
                                        <td class="text-center border">{{ round($data->kapitalis_sedang, 3) }}</td>
                                        <td class="text-center border">{{ round($data->kapitalis_besar, 3) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#tabelFuzzifikasi').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": "_all"
                }]
            });
        });
    </script>
@endsection
