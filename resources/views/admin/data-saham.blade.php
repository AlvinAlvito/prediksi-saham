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
                    <i class="uil uil-database"></i>
                    <span class="text">Data Saham</span>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                <div class="row justify-content-end mb-3">
                    <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSaham">
                            <i class="uil uil-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>

                <table id="datatable" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Saham</th>
                            <th>Nama Saham</th>
                            <th>PER</th>
                            <th>ROE</th>
                            <th>Volume</th>
                            <th>Market Cap</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($saham as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->kode_saham }}</td>
                                <td>{{ $item->nama_saham }}</td>
                                <td>{{ $item->per }}</td>
                                <td>{{ $item->roe }}</td>
                                <td>{{ $item->volume }}</td>
                                <td>{{ $item->market_cap }}</td>
                                <td>
                                    {{-- Tombol Edit (modal per item) --}}
                                    <a class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalEditSaham{{ $item->id }}">
                                        <i class="uil uil-edit"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.data-saham.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus saham ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="modalEditSaham{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.data-saham.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Saham</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Kode Saham</label>
                                                    <input type="text" name="kode_saham" class="form-control"
                                                        value="{{ $item->kode_saham }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama Saham</label>
                                                    <input type="text" name="nama_saham" class="form-control"
                                                        value="{{ $item->nama_saham }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>PER</label>
                                                    <input type="number" step="0.01" name="per" class="form-control"
                                                        value="{{ $item->per }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>ROE</label>
                                                    <input type="number" step="0.01" name="roe" class="form-control"
                                                        value="{{ $item->roe }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Volume</label>
                                                    <input type="number" name="volume" class="form-control"
                                                        value="{{ $item->volume }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Market Cap</label>
                                                    <input type="number" name="market_cap" class="form-control"
                                                        value="{{ $item->market_cap }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data saham.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Saham -->
    <div class="modal fade" id="modalTambahSaham" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.data-saham.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Saham</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode Saham</label>
                            <input type="text" name="kode_saham" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Saham</label>
                            <input type="text" name="nama_saham" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>PER</label>
                            <input type="number" step="0.01" name="per" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>ROE</label>
                            <input type="number" step="0.01" name="roe" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Volume</label>
                            <input type="number" name="volume" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Market Cap</label>
                            <input type="number" name="market_cap" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
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
