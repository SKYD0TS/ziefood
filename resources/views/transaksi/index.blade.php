@extends('templates.layout')


@section('content')
<div class="transaksi-container">
    <ul class="item content menu-container">
        @foreach($kategori as $j)
        <li>
            <h3>{{ $j->nama_kategori}}</h3>
            <ul class="menu-item" style="cursor: pointer;">
                @if(isset($j->menu) && count($j->menu) > 0)
                @foreach($j->menu as $menu)
                <li data-barang="menu" data-harga="{{ $menu->harga}}" data-id="{{ $menu->id}}" data-stok="{{ $menu->stok_id ? $menu->stok->jumlah:0}}" data-image="{{ $menu->image}}" data-nama_menu="{{ $menu->nama_menu }}">
                    <img width="100px" src="{{ asset('storage/menu-image') }}/{{ $menu->image}}" alt="">
                    <div>{{ $menu->nama_menu }}</div>
                    <div>Stok: {{ $menu->stok_id ? $menu->stok->jumlah:0 }}</div>
                    <div>Harga: {{ $menu->harga }}</div>
                </li>
                @endforeach
                @endif

                @if(isset($j->titipan) && count($j->titipan) > 0)
                @foreach($j->titipan as $titipan)
                <li data-barang="produkTitipan" data-harga="{{ $titipan->harga_jual}}" data-id="{{ $titipan->id}}" data-stok="{{$titipan->jumlah}}">
                    <div>{{ $titipan->nama_produk }}</div>
                    <div>Stok: {{ $titipan->jumlah }}</div>
                </li>
                @endforeach
                @endif
            </ul>
        </li>
        @endforeach

    </ul>
    <div class="item sidebar">
        <h1>Payment</h1>
        <ul class="ordered-list"></ul>
        <div>
            <p>Total Bayar :</p>
            <h2 id="total"><i class="fa fa-usd"></i> 0,00 </h2>
            <button id="btn-bayar" class="btn btn-primary">Bayar</button>
        </div>
    </div>
    <div class="item footer">Footer</div>
</div>


@endsection

@push('script')
<script>
    $(document).ready(function() {
        //your code here
    });

    $(function() {
        const orderedList = []
        let total = 0

        function sum() {
            return orderedList.reduce((accumulator, object) => {
                return accumulator + (object.harga * object.qty);
            }, 0)
        };

        const changeQty = (el, inc) => {
            const data = $(el).closest('li')[0].dataset
            const id = data.id + data.jenisBarang;
            console.log(data)
            const index = orderedList.findIndex(list => list.id == id)
            // orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc

            const txt_subtotal = $(el).closest('li').find('.subtotal')[0];
            const txt_qty = $(el).closest('li').find('.qty-item')[0]
            if (orderedList[index].qty == 1 && inc == -1) { // kalo qty == 1, mau ngurangin 1
                txt_qty.value = 1
                orderedList[index].qty = 1
            } else if (orderedList[index].qty == orderedList[index].stok && inc == 1) { // kalo qty == stok, mau nambah 1
                //abis
            } else {
                txt_qty.value = parseInt(txt_qty.value) + inc
                orderedList[index].qty += inc

            }
            txt_subtotal.innerHTML = orderedList[index].harga * orderedList[index].qty;

            $('#total').html(sum())
        }

        $('.ordered-list').on('click', '.btn-dec', function() {
            changeQty(this, -1)
        })
        $('.ordered-list').on('click', '.btn-inc', function() {
            changeQty(this, 1)
        })

        $('.ordered-list').on('click', '.remove-item', function() {
            const item = $(this).closest('li')[0];
            let index = orderedList.findIndex(list => list.id == (item.dataset.id + item.dataset.jenisBarang))
            orderedList.splice(index, 1)
            $(item).remove();
            $('#total').html(sum())
            console.log(orderedList, index)
        })

        $('#btn-bayar').on('click', function() {
            console.log(orderedList)
            $.ajax({
                url: "{{ route('transaksi.store') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    orderedList: orderedList,
                    total: sum()
                },
                success: function(data) {
                    console.log(data),
                        Swal.fire({
                            title: data.message,
                            showDenyButton: true,
                            confirmButtonText: "Cetak Nota",
                            denyButtonText: `ok`
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open(`{{ url('nota') }}/${data.nota}`)
                                location.reload()
                            } else if (result.isDenied) {
                                location.reload()
                            }

                        });
                },
                error: function(request, status, error) {
                    console.log(request, status, error)
                    Swal.fire('Pemesanan Gagal!')
                }
            })
        })

        $(".menu-item li").click(function() {
            const data = $(this)[0].dataset;
            const jenisBarang = data.barang; // Mendapatkan jenis dari produk
            const menu_clicked = $(this).text();
            const harga = parseFloat(data.harga);
            const stok = parseFloat(data.stok);
            const id = parseInt(data.id);
            const nama_menu = data.nama_menu;
            if (stok == 0) {
                return
            }
            // if (jenisBarang === 'menu') {
            // Logika untuk menambahkan menu
            if (orderedList.every(list => list.id !== id + jenisBarang)) {
                let dataN = {
                    'id': id + jenisBarang,
                    'barang_id': id,
                    'barang': jenisBarang,
                    'menu': menu_clicked,
                    'harga': harga,
                    'stok': stok,
                    'qty': 1
                };
                orderedList.push(dataN);

                let listOrder = `<li data-jenis-barang="${jenisBarang}" data-id="${id}" data-stok="${stok}">
                <h4>
                    <p>${nama_menu}</p>
                </h4>
                <h5>
                    <p>Rp.${harga}</p>
                </h5>
                `;
                listOrder += `<button class="btn-dec"> - </button>`;
                listOrder += `<input class="qty-item" type="number" value="1" style="3rem" readonly/>
                                <button class="btn-inc">+</button><br>
                                <button class="remove-item">Hapus</button>
                                <span class="subtotal">${harga * 1}</span>
                                </li>`;
                $(".ordered-list").append(listOrder);
            }
            // } else if (jenisBarang === 'produkTitipan') {
            //     // Logika untuk menambahkan titipan
            //     if (orderedList.every(list => list.id !== id + jenisBarang)) {
            //         let dataN = {
            //             'id': id + jenisBarang,
            //             'barang_id': id,
            //             'barang': 'produkTitipan',
            //             "menu": menu_clicked,
            //             'harga': harga,
            //             'stok': stok,
            //             "qty": 1
            //         };
            //         orderedList.push(dataN);
            //         let listOrder = `<li data-jenis-barang="${jenisBarang}" data-id="${id}" data-stok="${stok}"> <h3>${menu_clicked}</h3>`;
            //         listOrder += `<button class="btn-dec"> - </button>`;
            //         listOrder += `<input class="qty-item" type="number" value="1" style="3rem" readonly/>
            //                     <button class="btn-inc">+</button><br>
            //                     <button class="remove-item">Hapus</button>
            //                     <span class="subtotal">${harga * 1}</span>
            //                     </li>`;
            //         $(".ordered-list").append(listOrder);
            //     }
            // }
            console.log(orderedList)
            $("#total").html(sum());
        });

    });
</script>
@endpush