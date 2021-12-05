@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="http://[::1]/codepos-app/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item active">Barang</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Barang
                <a href="{{ route('items.create') }}"
                   class="btn btn-primary btn-icon icon-left float-right">
                    <i class="fa fa-plus"></i>
                    Tambah Barang
                </a>
            </h2>
            <p class="section-lead">Daftar Barang</p>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="items-data">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Foto Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Merk</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $("#items-data").dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.master-data.items') }}",
                columns: [
                    {
                        data: 'id',
                        name: "No.",
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'image',
                        className: 'text-center',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'brand',
                    },
                    {
                        data: 'purchase_price',
                    },
                    {
                        data: 'selling_price',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });
        </script>
    @endpush
@endsection
