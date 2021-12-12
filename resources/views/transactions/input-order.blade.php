@extends('layouts.app')

@section('content')
    @push('styles')
        <style>
            #order-table tr th, #order-table tr td {
                border-color: #dad7d7fa !important;
            }

            .col-item-number {
                width: 20px !important;
            }

            .col-item-name {
                width: 160px !important;
            }

            .col-item-qty {
                width: 60px !important;
            }

            .col-item-action {
                width: 100px !important;
            }

            .qty {
                text-align: center;
            }
        </style>
    @endpush

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
                Input Order
            </h2>
            <p class="section-lead">
                Silahkan isi form di bawah untuk menambahkan data order.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Transaksi</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-light" href="#">
                                    <i class="fas fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="collapse show" id="mycard-collapse" style="">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-bold">No. Transaksi</td>
                                        <td>:</td>
                                        <td>{{ $transaction->number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Tanggal Belanja</td>
                                        <td>:</td>
                                        <td>{{ $transaction->shopping_date }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Status</td>
                                        <td>:</td>
                                        <td>{{ $transaction->status }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form Input Order</h4>
                            <div class="card-header-action">
                                <a data-collapse="#form-input-order-collapse" class="btn btn-icon btn-light" href="#">
                                    <i class="fas fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="collapse show" id="form-input-order-collapse">
                            <div class="card-body">
                                <form id="form-order" action="{{ route('transactions.order.store', $transaction->id) }}"
                                      method="POST">
                                    @csrf
                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label for="customer" class="col-sm-2 col-form-label">Pelanggan</label>
                                                <div class="col-sm-3">
                                                    <select name="customer_id" id="customer"
                                                            class="form-control select2"
                                                            required>
                                                        <option value="" selected disabled>-- Pilih Pelanggan --
                                                        </option>
                                                        @foreach($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('customer')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="items" class="col-sm-2 col-form-label">Barang</label>
                                                <div class="col-sm-10">
                                                    <button type="button" onclick="addRowItem()" class="btn btn-light">
                                                        <i class="fa fa-plus"></i>
                                                        <span>Tambah Barang</span>
                                                    </button>

                                                    <table id="order-table"
                                                           class="table table-sm table-hover table-striped table-bordered mt-2">
                                                        <thead>
                                                        <tr>
                                                            <th class="col-item-number">No.</th>
                                                            <th class="col-item-name">Nama Barang</th>
                                                            <th class="col-item-qty">Qty</th>
                                                            <th class="col-item-action">Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="list-item">
                                                        <tr class="row_1">
                                                            <td class="text-center align-middle">1</td>
                                                            <td>
                                                                <select name="items[]" onchange="setPrice(this)"
                                                                        class="form-control select-item select2"
                                                                        required>
                                                                    <option value="" disabled selected>-- Pilih Barang
                                                                        --
                                                                    </option>
                                                                    @foreach($items as $item)
                                                                        <option data-price="{{ $item->selling_price }}" value="{{ $item->id }}">{{ $item->name }}
                                                                            ({{ $item->brand }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number" min="1" name="qty[]"
                                                                       class="form-control qty qty-1" required>
                                                                <input type="hidden" name="price[]" class="price price-1">
                                                            </td>
                                                            <td class="text-center">
                                                                <button disabled class="btn btn-danger disabled"
                                                                        type="button">
                                                                    <span>Hapus</span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    @error('customer')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="submit" class="col-sm-2 col-form-label">&nbsp;</label>
                                                <div class="col-sm-10 text-right">
                                                    <button class="btn btn-primary" type="button"
                                                            onclick="submitForm()">
                                                        <i class="fa fa-save"></i>
                                                        <span>Simpan Order</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Data Order (Penitip)</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Daftar Barang</th>
                                    <th>Total Barang</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transaction->orders as $order)
                                    <tr>
                                        <td width="10" class="align-middle text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>
                                            <ul>
                                            @foreach($order->orderItems as $item)
                                                <li>{{ $item->item->name }} - {{ $item->qty }}</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $order->order_items_sum_qty }}
                                        </td>
                                        <td>
                                            <button onclick="confirmDelete('transactions/delete-order', '{{ $order->id }}')" class="btn btn-danger" type="button">
                                                <span>Hapus</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script type="text/javascript">
            //Item selection
            let itemSelection = `<select onchange="setPrice(this)" name="items[]" class="form-control select-item">`;
            itemSelection += `<option value='' disabled selected>-- Pilih Barang --</option>`;
            @foreach($items as $item)
                itemSelection += `<option data-price="{{ $item->selling_price }}" value="{{ $item->id }}">{{ $item->name }} ({{ $item->brand }})</option>`;
            @endforeach
                itemSelection += `</select>`;

            const listItemWrapper = document.querySelector('#list-item');

            const addRowItem = () => {
                const rowIndex = document.querySelectorAll('#list-item > tr').length + 1;
                const number = `<td class="text-center align-middle">${rowIndex}</td>`;
                const inputItemSelection = `<td>${itemSelection}</td>`;
                const inputQty = `<td class="text-center">
                                    <input type="number" min="1" name="qty[]" class="form-control qty qty-${rowIndex}" required>
                                    <input type="hidden" name="price[]" class="price price-${rowIndex}">
                                  </td>`;
                const actionButton = `<td class="text-center">
                                        <button onclick="deleteRow(${rowIndex})" class="btn btn-danger" type="button">
                                            <span>Hapus</span>
                                        </button>
                                      </td>`;

                const rowItem = document.createElement('tr');
                rowItem.setAttribute('class', `row_${rowIndex}`);

                rowItem.innerHTML = number + inputItemSelection + inputQty + actionButton;
                listItemWrapper.appendChild(rowItem);

                $(".select-item").select2();
            }

            const deleteRow = (index) => {
                //Remove selected row
                document.querySelector(`#list-item > tr.row_${index}`).remove();

                //Reset order number
                document.querySelectorAll(`#list-item > tr`).forEach((elm, index) => elm.children[0].textContent = index + 1);
            }

            const submitForm = () => {
                let isError = false;
                /*
                * Validate customer
                * */
                const customerId = document.querySelector('#customer').value;
                if (customerId === '' || parseInt(customerId) <= 0) {
                    Swal.fire('Error', 'Silahkan pilih pelanggan terlebih dahulu!', 'error')
                        .then(function () {
                            $("#customer").select2('open');
                        });
                    isError = true;
                }

                /*
                * Validate items and qty
                * Make sure selected items count and qty count is same
                * */
                let selectedItemCount = 0;
                let inputQtyCount = 0;
                document.querySelectorAll('.select-item').forEach(el => {
                    el.value !== '' && parseInt(el.value) !== 0 ? selectedItemCount++ : ''
                });

                document.querySelectorAll('.qty').forEach(el => {
                    el.value !== '' && parseInt(el.value) !== 0 ? inputQtyCount++ : ''
                });

                if (selectedItemCount === 0 || inputQtyCount === 0 || selectedItemCount !== inputQtyCount) {
                    Swal.fire('Error', 'Pastikan pilihan barang dan jumlah barang sudah sesuai!', 'error');
                    isError = true;
                }

                if (!isError) {
                    document.querySelector('#form-order').submit();
                }
            }

            const setPrice = (el) => {
                const index = el.parentNode.parentElement.getAttribute('class').split('_')[1];
                document.querySelector(`.price-${index}`).value = el.options[el.selectedIndex].getAttribute('data-price');
            }
        </script>
    @endpush
@endsection
