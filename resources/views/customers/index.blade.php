@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="http://[::1]/codepos-app/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item active">Barang</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Pelanggan
                <a href="#" onclick="showFormCustomer()"
                   class="btn btn-primary btn-icon icon-left float-right">
                    <i class="fa fa-plus"></i>
                    Tambah Pelanggan
                </a>
            </h2>
            <p class="section-lead">Daftar Data Pelanggan</p>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-striped" id="items-data">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Telpon</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-form-customer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('customers.index') }}" id="form-customer" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @csrf
                        @method('POST')
                        <label for="customer-name">Nama Pelanggan</label>
                        <input type="text" autocomplete="off" name="name" value="{{ old('name') }}" id="customer-name"
                               class="form-control @error('name') is-invalid @enderror" required>

                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                        <label for="customer-name">No. Telpon</label>
                        <div class="input-group">
                            <div class="input-group-text">+62</div>
                            <input type="number" name="phone" value="{{ old('phone') }}" autocomplete="off"
                                   id="customer-phone" class="form-control @error('phone') is-invalid @enderror"
                                   required>
                        </div>

                        @error('phone')
                        <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $("#items-data").dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.master-data.customers') }}",
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
                        data: 'name',
                    },
                    {
                        data: 'phone',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });

            @if($errors->has('name') || $errors->has('phone'))
            $("#modal-form-customer").modal('show');
            @endif
        </script>
    @endpush
@endsection
