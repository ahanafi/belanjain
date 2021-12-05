@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="http://[::1]/codepos-app/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item "><a href="http://[::1]/codepos-app/pelanggan">Barang</a></div>
                <div class="breadcrumb-item  active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Barang</h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk memperbarui data barang.
            </p>

            <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card card-primary">
                            <div class="card-body">

                                <x-input type="text" is-required="true" field-name="name" value="{{ $item->name }}" placeholder="Nama Barang" label="Nama Barang"></x-input>

                                <x-input type="text" is-required="true" field-name="brand" value="{{ $item->brand }}" placeholder="Merk" label="Merk"></x-input>

                                <x-input type="number" is-required="true" field-name="purchase_price" value="{{ removeDecimal($item->purchase_price) }}" placeholder="Harga beli" label="Harga beli"></x-input>

                                <x-input type="number" is-required="true" field-name="selling_price" value="{{ removeDecimal($item->selling_price) }}" placeholder="Harga jual" label="Harga jual"></x-input>

                                <x-input type="file" field-name="image" label="Foto"></x-input>

                                <div class="text-right">
                                    <button name="submit" class="btn btn-primary mr-1" type="submit">Simpan Data</button>
                                    <a href="{{ route('items.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
