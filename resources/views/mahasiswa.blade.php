@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Data Mahasiswa</h2>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" id="btn-tambah" data-bs-target="#modal-mahasiswa">Tambah Mahasiswa</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="table-mahasiswa">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Jurusan</th>
                                <th>Alamat</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> 

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="modal-mahasiswa" tabindex="-1" aria-labelledby="modal-mahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-mahasiswaLabel">Tambah Mahasiswa</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-mahasiswa">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" placeholder="Masukkan NIM" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
<select class="form-control" id="jk" name="jk" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" placeholder="Masukkan Tanggal Lahir" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Manajemen">Manajemen</option>
                                <option value="Akuntansi">Akuntansi</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Sosial">Sosial</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea placeholder="Masukkan Alamat" class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Mahasiswa -->
    <div class="modal fade" id="hapusMahasiswa" tabindex="-1" aria-labelledby="hapusMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusMahasiswaLabel">Hapus Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <b id="nama-hapus"></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" data-nim="" id="hapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
        <script>
            var table;
            $(document).ready(function() {
                table = $('#table-mahasiswa').DataTable({
                    // processing: true,
                    // serverSide: true,
                    ajax: {
                        url: "api/mahasiswa",
                        dataSrc: function(json) {
                            console.log('DataTable AJAX response:', json);
                            return json.data;
                        }
                    },
                    order: [[0, 'desc']],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    columns: [
                        {data: 'nim', name: 'nim'},
                        {data: 'nama', name: 'nama'},
                        {data: 'jk', name: 'jk'},
                        {data: 'tgl_lahir', name: 'tgl_lahir'},
                        {data: 'jurusan', name: 'jurusan'},
                        {data: 'alamat', name: 'alamat'},
                        {data:'nim', render: function(data) {
                            return '<div class="d-flex justify-content-center m-2">'+
                                        '<button type="button" class="btn btn-warning btn-sm m-2" id="editMahasiswa" data-bs-toggle="modal" data-bs-target="#modal-mahasiswa" data-nim="'+data+'">Edit</button>'+
                                        '<button type="button" class="btn btn-danger btn-sm m-2" id="hapusModal" data-bs-toggle="modal" data-bs-target="#hapusMahasiswa" data-nim="'+data+'">Hapus</button>'+
                                    '</div>';
                        }},
                    ]
                });

                $('#btn-tambah').click(function() {
                    $('#btn-update').text('Simpan');
                    $('#btn-update').attr('id', 'btn-simpan');
                    $('#nim').val('');
                    $('#nama').val('');
                    $('#jk').val('');
                    $('#tgl_lahir').val('');
                    $('#jurusan').val('');
                    $('#alamat').val('');
                    $('#nim').prop('disabled', false);
                    $('#modal-mahasiswa').modal('show');
                });

                var ambilData = function() {
                    return {
                        nama: $('#nama').val(),
                        nim: $('#nim').val(),
                        jk: $('#jk').val(),
                        tgl_lahir: $('#tgl_lahir').val(),
                        jurusan: $('#jurusan').val(),
                        alamat: $('#alamat').val()
                    };
                };

                $(document).on('click', '#btn-simpan', function(e) {
                    e.preventDefault();
                    var data = ambilData();
                    $.ajax({
                        url: "api/mahasiswa",
                        type: "POST",
                        data: {
                            nama: data.nama,
                            nim: data.nim,
                            jk: data.jk,
                            tgl_lahir: data.tgl_lahir,
                            jurusan: data.jurusan,
                            alamat: data.alamat
                        },
                        success: function(response) {
                            table.ajax.reload();
                            $('#modal-mahasiswa').modal('hide');
                            $('#form-tambah-mahasiswa')[0].reset();
                            alert('Data berhasil ditambahkan');
                            toastr.success('Data berhasil ditambahkan');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Data gagal ditambahkan');
                            toastr.error('Data gagal ditambahkan');
                        }
                    });
                });

                $(document).on('click', '#editMahasiswa', function(event) {
                    var nim = $(this).data('nim');
                    $('#btn-simpan').text('Update');
                    $('#btn-simpan').attr('id', 'btn-update');
                    $.ajax({
                        url: "api/mahasiswa/" + nim,
                        type: "GET",
                        success: function(response) {
                            console.log(response);
                            $('#nama').val(response.data.nama);
                            $('#nim').val(response.data.nim).prop('disabled', true);
                            $('#jk').val(response.data.jk);
                            $('#tgl_lahir').val(response.data.tgl_lahir);
                            $('#jurusan').val(response.data.jurusan);
                            $('#alamat').val(response.data.alamat);
                            $('#modal-mahasiswa').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Data gagal diambil');
                            toastr.error('Data gagal diambil');
                        }
                    });
                });

                $(document).on('click', '#btn-update', function(e) {
                    e.preventDefault();
                    var data = ambilData();
                    $.ajax({
                        url: "api/mahasiswa/" + data.nim,
                        type: "PUT",
                        data: data,
                        success: function(response) {
                            table.ajax.reload();
                            $('#modal-mahasiswa').modal('hide');
                            $('#form-tambah-mahasiswa')[0].reset();
                            toastr.success('Data berhasil diupdate');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            $('#form-tambah-mahasiswa')[0].reset();
                            toastr.error('Data gagal diupdate');
                        }
                    });
                });

                $(document).on('click', '#hapusModal', function(event) {
                    $('#hapusMahasiswa').modal('show');
                    var nim = $(this).data('nim');
                    $('#hapus').data('nim', nim);
                    $.ajax({
                        url: "api/mahasiswa/" + nim,
                        type: "GET",
                        success: function(response) {
                            $('#nama-hapus').text(response.data.nama);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Data gagal diambil');
                            toastr.error('Data gagal diambil');
                        }
                    });
                });

                $(document).on('click', '#hapus', function(event) {
                    var nim = $(this).data('nim');
                    console.log(nim);
                    $.ajax({
                        url: "api/mahasiswa/" + nim,
                        type: "DELETE",
                        success: function(response) {
                            table.ajax.reload();
                            $('#hapusMahasiswa').modal('hide');
                            toastr.success('Data berhasil dihapus');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Data gagal dihapus');
                            toastr.error('Data gagal dihapus');
                        }
                    });
                });
            });
        </script>
    @endsection
