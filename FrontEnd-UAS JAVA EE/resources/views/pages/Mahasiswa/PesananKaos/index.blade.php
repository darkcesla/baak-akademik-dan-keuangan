@extends('layouts_mahasiswa.master')
@section('title', 'Pemesanan Kaos')
@section('page', 'Pemesanan Kaos')
@section('breadcrumb')
    <!-- ... (breadcrumb code) ... -->
@endsection
@section('styles')
    <style>
        .pagination-link {
            margin: 0 5px; /* Atur margin di antara tautan */
            padding: 5px 10px; /* Atur padding di dalam tautan */
            border: 1px solid #007BFF; /* Warna border */
            border-radius: 4px; /* Untuk sudut yang melengkung */
            color: #007BFF; /* Warna teks */
        }

        .pagination-link.active {
            background-color: #007BFF; /* Warna latar belakang untuk tautan yang aktif */
            color: #fff; /* Warna teks untuk tautan yang aktif */
        }
    </style>
@endsection


@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <a href="{{ route('Add_PaymentKaos') }}" class="btn btn-primary ms-auto">Beli Kaos</a>
                        <a href="{{ route('Kaos_Mahasiswa') }}" class="btn btn-primary ">Lihat Kaos</a>
                    </div>
                    <div class="card-body pt-0">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif  
                      <h1> Pemesanan Kaos </h1>
                      <hr>
                    
                        @if(count($pemesanankaos) > 0)
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Ukuran Kaos</th>
                                        <th>Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesanankaos as $data)
                                        <tr>
                                            <td>{{ $data['id'] }}</td>
                                            <td>{{ $data['user']['nama_Lengkap'] }} - {{ $data['user']['nim'] }}</td>
                                            <td>{{ $data['kaos']['ukuran'] }}
                                            <td>Dibayar Dengan :{{ $data['jenis_pembayaran'] }} 
                                                <p>&nbsp;</p>
                                                Dengan Nominal :Rp. {{ number_format($data['nominal_pembayaran'], 0, ',', '.') }}</td>
                                            </tr>
                                    @endforeach
                                </tbody>
                             </table>
                             <div class="mt-4 d-flex justify-content-center">
                            <div id="pagination-links" class="mt-4">
                            </div>
                        @else
                            <p>Tidak Ada Data Pesanan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tableRows = document.querySelectorAll('.table tbody tr');
            var rowsPerPage = 10; // Jumlah baris per halaman
            var paginationContainer = document.getElementById('pagination-links');
            var totalRows = tableRows.length;
            var currentPage = 1; // Halaman saat ini
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            function showPage(page) {
                currentPage = page;

                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;

                tableRows.forEach(function(row, index) {
                    if (index >= start && index < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                updatePaginationLinks(); // Memperbarui tampilan kotak pagination
            }

            function createPaginationLinks() {
                var links = '';
                for (var i = 1; i <= totalPages; i++) {
                    links += `<span style="padding:10px;margin:5px;" class="border border-primary"><a href="#" class="pagination-link " data-page="${i}">${i}</a></span>`;
                }
                paginationContainer.innerHTML = links;

                updatePaginationLinks(); // Memperbarui tampilan kotak pagination
            }

            function updatePaginationLinks() {
                var paginationLinks = paginationContainer.querySelectorAll('.pagination-link');
                paginationLinks.forEach(function(link) {
                    link.classList.remove('active');
                    if (parseInt(link.getAttribute('data-page')) === currentPage) {
                        link.classList.add('active');
                    }
                });
            }

            showPage(1); // Menampilkan halaman pertama saat halaman dimuat
            createPaginationLinks();

            paginationContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('pagination-link')) {
                    var selectedPage = parseInt(event.target.getAttribute('data-page'));
                    showPage(selectedPage);
                }
            });
        });

        function filterByStatus() {
            var statusFilter = document.getElementById('statusFilter');
            var selectedStatus = statusFilter.value;
            var table = document.querySelector('.table');

            var rows = table.getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var statusCell = row.getElementsByTagName('td')[5]; // Ubah indeks sesuai dengan kolom status

                if (selectedStatus === 'All') {
                    row.style.display = '';
                } else {
                    if (statusCell) {
                        var cellText = statusCell.textContent || statusCell.innerText;
                        if (cellText !== selectedStatus) {
                            row.style.display = 'none';
                        } else {
                            row.style.display = '';
                        }
                    }
                }
            }
        }
    </script>
@endsection




