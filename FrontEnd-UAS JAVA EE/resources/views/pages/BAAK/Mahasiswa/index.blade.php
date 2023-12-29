@extends('layouts.master')
@section('title', 'User')
@section('page', 'User')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Data Mahasiswa</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container--> 
            <div id="kt_content_container" class="container-xxl">
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Products-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                     
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">  
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <h1>User</h1>
                                    @if(count($users) > 0)
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Username</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>NIM</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $data)
                                                    <tr>
                                                        <td>{{ $data['id'] }}</td>
                                                        <td>{{ $data['username'] }}</td>
                                                        <td>{{ $data['nama_Lengkap'] }}</td>
                                                        <td>{{ $data['nim'] }}</td>
                                                        <td> 
                                                            <a href="{{ route('Edit_User', ['id' => $data['id']]) }}" class="btn-edit">
                                                            <i class="fa fa-copy	
                                                            "></i> Edit |
                                                          </a>
                                                          <!-- Tombol hapus dengan ikon -->
                                                          <a href="{{ route('Delete_User', ['id' => $data['id']]) }}" class="btn-delete">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                          </a>
                                                        </td> 
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <div id="pagination-links" class="mt-4">
                                    @else
                                        <p>Tidak ada data User.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
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
    </script>
@endsection





      
 
