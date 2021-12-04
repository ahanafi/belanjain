@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="http://[::1]/codepos-app/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item "><a href="http://[::1]/codepos-app/pelanggan">Barang</a></div>
                <div class="breadcrumb-item  active">Tambah</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Barang</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk menambahkan data barang baru.
            </p>

            <form action="{{ route('items.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-body">

                                <x-input type="text" is-required="true" field-name="name" placeholder="Nama Barang" label="Nama Barang"></x-input>

                                <x-input type="text" is-required="true" field-name="brand" placeholder="Merk" label="Merk"></x-input>

                                <x-input type="number" is-required="true" field-name="purchase_price" placeholder="Harga beli" label="Harga beli"></x-input>

                                <x-input type="number" is-required="true" field-name="selling_price" placeholder="Harga jual" label="Harga jual"></x-input>

                                <div class="text-right">
                                    <button name="submit" class="btn btn-primary mr-1" type="submit">Simpan Data</button>
                                    <button name="reset" class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
