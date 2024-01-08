@extends('master')
@section('konten')

<div class="container-fluid">
    <div class="text-end m-2"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahbarang"> + Tambah transaksi Baru</button></div>
    @if(session('message'))
    <div class="alert alert-success m-3"> {{session('message')}} </div>
    @endif
    <table class="table table-dark table-hover m-lg-2">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
           
            <th>Harga</th>
            <th>Stok</th>
            <th>Option</th>
        </tr>
        @foreach ($barang as $p)
        <tr>
            <td> {{$p->kode}}<br><img src="/assets/img/{{$p->gambar}}" alt="" width="80px" height="100px"> </td>
            <td> {{$p->nama}} </td>
            <td>Rp. {{$p->harga}} </td>
            <td> {{$p->stok}} </td>
            <td>

                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ModalUpdatebarang{{ $p->kode }}">Update</button>
                |
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeletebarang{{ $p->kode }}">Delete</button>
            </td>
        </tr>

        <!-- Ini tampil form update barang -->
        <div class="modal fade" id="ModalUpdatebarang{{ $p->kode }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/barang/storeupdate" method="post" class="form-floating">
                            @csrf
                            <div class="form-floating p-1">
                                <input type="text" name="kode" id="kode" readonly class="form-control" value="{{ $p->kode }}">
                                <label for="floatingInputValue">Kode</label>
                            </div>
                            <div class="form-floating p-1">
                                <input type="text" name="nama" required="required" class="form-control" value="{{ $p->nama }}">
                                <label for="floatingInputValue">Nama</label>
                            </div>
                            
                            <div class="form-floating p-1">
                                <input type="text" name="harga" required="required" class="form-control" value="{{ $p->harga }}">
                                <label for="floatingInputValue">Harga (Rp.)</label>
                            </div>
                            <div class="form-floating p-1">
                                <input type="text" name="stok" required="required" class="form-control" value="{{ $p->stok }}">
                                <label for="floatingInputValue">Stok</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Updates</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ini tampil form delete barang -->
        <div class="modal fade" id="ModalDeletebarang{{$p->kode}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/barang/delete/{{$p->kode}}" method="get" class="form-floating">
                            @csrf
                            <div>
                                <h3>Yakin mau menghapus data <b>{{$p->nama}}</b> ?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </table>
</div>

<!-- Ini tampil form tambah barang -->
<div class="modal fade" id="ModalTambahbarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/barang/storeinput" method="post" class="form-floating" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating p-1">
                        <input type="text" name="kode" required="required" class="form-control">
                        <label for="floatingInputValue">Kode</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="nama" required="required" class="form-control">
                        <label for="floatingInputValue">Nama</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="harga" required="required" class="form-control">
                        <label for="floatingInputValue">Harga (Rp.)</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="text" name="stok" required="required" class="form-control">
                        <label for="floatingInputValue">Stok</label>
                    </div>
                    <div class="form-floating p-1">
                        <input type="file" name="gambar" required="required" class="form-control">
                        <label for="floatingInputValue">Gambar</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection