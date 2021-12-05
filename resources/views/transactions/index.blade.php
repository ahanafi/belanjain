@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="http://[::1]/codepos-app/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item active">Barang</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                Daftar Transaksi
                <a href="#" onclick="showFormTransaction()"
                   class="btn btn-primary btn-icon icon-left float-right">
                    <i class="fa fa-plus"></i>
                    Tambah Transaksi
                </a>
            </h2>
            <p class="section-lead">Daftar Data Transaksi</p>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-striped" id="transactions-data">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal Belanja</th>
                                    <th>Status</th>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-form-transaction">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="latest-number" value="{{ $number }}">
                <form action="{{ route('transactions.index') }}" id="form-transaction" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @csrf
                        @method('POST')
                        <label for="transaction-number">No. Transaksi</label>
                        <input type="text" name="number" value="{{ $number }}"
                               id="transaction-number"
                               class="form-control @error('number') is-invalid @enderror" required readonly>

                        @error('number')
                        <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>

                        <label for="transaction-number">Tanggal Belanja</label>
                        <input type="date" autocomplete="off" name="shopping_date" value="{{ old('shopping_date') }}"
                               id="shopping-date"
                               class="form-control @error('shopping_date') is-invalid @enderror" required>

                        @error('shopping_date')
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
            $("#transactions-data").dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.master-data.transactions') }}",
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
                        data: 'number',
                    },
                    {
                        data: 'shopping_date',
                    },
                    {
                        data: 'status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });

            @if($errors->has('shopping_date') || $errors->has('number'))
            $("#modal-form-transaction").modal('show');
            @endif
        </script>
    @endpush
@endsection
