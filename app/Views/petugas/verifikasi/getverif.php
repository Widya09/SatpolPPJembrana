<?= $this->extend('layout_petugas/default_t') ?>

<?= $this->section('title') ?>
<title>Data Verifikasi &mdash; Welcome Admin</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Pengaduan</h1>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">X</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">X</button>
                <b>Success !</b>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Pengajuan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md display nowrap dataTable dtr-inline" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Aduan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($pengaduan as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->nik ?></td>
                                <td><?= $value->jenis_aduan ?></td>
                                <td><?= date('d/m/Y', strtotime($value->tgl_pengaduan)) ?></td>
                                <td>
                                    <!-- Cek status -->
                                    <a class="btn <?= ($value->status == 0) ? 'btn-danger' : 'btn-success' ?> btn-sm"><?= ($value->status == 0) ? 'Pending' : 'Terverifikasi' ?></i></a>
                                </td>
                                <td><a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="lihatdetail('<?= $value->id_pengaduan; ?>')"><i class="fas fa-eye">Detail</i></a></td>
                                <td class="text-center" style="width:15%">
                                    <?php if ($value->status == 0) { ?>
                                        <a href="<?= site_url('petugas/verifikasi/addverif/' . $value->id_pengaduan) ?>" class="btn btn-warning btn-info btn-sm"><i class="fas fa-user-check"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Nama:<p id="nama_p"></p>
                NIK:<p id="nik_p"></p>
                Nomor Handphone:<p id="no_hp_p"></p>
                Jenis Aduan: <p id="jenis_aduan_p"></p>
                Sasaran:<p id="sasaran_p"></p>
                Status: <p><a class="btn <?= ($value->status == 0) ? 'btn-danger' : 'btn-success' ?> btn-sm"><?= ($value->status == 0) ? 'Pending' : 'Terverifikasi' ?></i></a></p>
                Waktu Pengaduan:<p id="waktu_p"></p>
                Tanggal Pengaduan:<p id="tanggal_p"> </p>
                Lokasi Kejadian:<p id="lokasi_p"> </p>
                Kecamatan:<p id="kecamatan_p"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->




<script>
    // fungsi untuk hapus data
    //pilih selector dari table id pengaduan dengan class .delete
    $(document).ready(function() {
        // $('#table1').DataTable();
        // $(".remove").click(function() {
        //   var id_pengaduan = $(this).val();
        //   console.log(id_pengaduan);
        //   alert(id_pengaduan);


        // });
    });

    function lihatdetail(id_pengaduan) {
        $.ajax({
            url: "<?php echo site_url('admin/pengaduan/detail') ?>/" + id_pengaduan,
            type: "GET",
            dataType: "json",


            success: function(response) {
                console.log(response);
                $('#nama_p').html(response.pengaduan.nama);
                $('#nik_p').html(response.pengaduan.nik);
                $('#no_hp_p').html(response.pengaduan.nomor_hp);
                $('#jenis_aduan_p').html(response.pengaduan.jenis_aduan);
                $('#sasaran_p').html(response.pengaduan.sasaran);
                $('#status_p').html(response.pengaduan.status);
                $('#waktu_p').html(response.pengaduan.waktu);
                // $('#tanggal_p').html(response.pengaduan[0].tgl_pengaduan);
                $('#tanggal_p').html(response.pengaduan.tgl_pengaduan);
                $('#lokasi_p').html(response.pengaduan.lokasi);
                $('#kecamatan_p').html(response.pengaduan.keterangan);
                $('#modaldetail').modal('show');
            }
        });
    }

    function remove(id_pengaduan) {
        Swal.fire({
                title: "Apakah anda yakin?",
                text: "Apabila terhapus anda tidak akan mendapatkan datanya kembali",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
            })
            .then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('admin/pengaduan/delete') ?>/" + id_pengaduan,
                        type: "DELETE",
                        data: $('#form').serialize(),

                        success: function(response) {
                            if (response) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Data anda telah terhapus',
                                    icon: 'success',
                                    showCancelButton: false,
                                    showConfirmButton: true
                                }).then(
                                    (confirmed) => {
                                        window.location.href = "<?php echo site_url('admin/pengaduan') ?>";
                                    }
                                );

                            }
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Data tidak jadi dihapus!',
                        text: 'Mantap!',
                        type: 'error'
                    })
                }
            });
    }
</script>


<script>
    $(document).ready(function() {

        // $("#simpan").click(function() {

        //     var nama = $('#nama').val();
        //     var nik = $('#nik').val();
        //     var nomor_hp = $('#nomor_hp').val();
        //     var jenis_aduan = $('#jenis_aduan').val();
        //     var sasaran = $('#sasaran').val();
        //     var waktu = $('#waktu').val();
        //     var tgl_pengaduan = $('#tgl_pengaduan').val();
        //     var lokasi = $('#lokasi').val();
        //     var status = $('#status').val();

        //     $.ajax({

        //         url: "<?php echo site_url('pengaduan') ?>",
        //         type: "POST",
        //         data: $('#form').serialize(),

        //         success: function(response) {
        //             if (response) {
        //                 Swal.fire({
        //                         icon: 'success',
        //                         title: 'Data Berhasil disimpan!',
        //                         text: 'Anda akan di arahkan dalam 3 Detik',
        //                         timer: 3000,
        //                         showCancelButton: false,
        //                         showConfirmButton: false
        //                     })
        //                     .then(function() {
        //                         window.location.href = "<?php echo site_url('pengaduan') ?>";
        //                     });
        //             } else {
        //                 console.log(response);
        //                 $("#nama").attr("required", "required");
        //                 $("#nik").attr("required", "required");

        //                 $("#nama_error").text("Nama Harus diisi terlebih dahulu !");
        //                 $("#nik_error").text("NIK Harus diisi terlebih dahulu !");
        //                 $("#no_hp_error").text("Nomor HP Harus diisi terlebih dahulu !");
        //                 $("#waktu_error").text("Waktu Harus diisi terlebih dahulu !");
        //                 $("#sasaran_error").text("Sasaran Harus diisi terlebih dahulu !");
        //                 $("#tanggal_error").text("Tanggal Harus diisi terlebih dahulu !");
        //                 $("#lokasi_error").text("Lokasi Harus diisi terlebih dahulu !");

        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Data belum berhasil disimpan!',
        //                     text: 'silahkan coba lagi!'
        //                 });
        //             }

        //             // console.log(response);

        //         },
        //         error: function(response) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Data error!',
        //                 text: 'silahkan coba lagi!'
        //             });
        //         }
        //     });



        // });

        // validator = $("#form").validate({
        //     submitHandler: function(form) {
        //         $('#notloading').attr('hidden', true);

        //         $('.loading-icon').removeAttr('hidden');
        //         $('#btn-submit').attr('disabled', 'disabled');
        //         $('.btn-text').html('Loading . . .');

        //         // var toast_text;
        //         var url = "<?php echo site_url('pengaduan') ?>";
        //         $.ajax({
        //             url: url,
        //             type: "POST",
        //             data: $(form).serialize(),
        //             success: function(response) {
        //                 $('[name=<?= csrf_token() ?>]').val(response.csrf);
        //                 Swal.fire({
        //                         icon: 'success',
        //                         title: 'Data Berhasil disimpan!',
        //                         text: 'Anda akan di arahkan dalam 3 Detik',
        //                         timer: 3000,
        //                         showCancelButton: false,
        //                         showConfirmButton: false
        //                     })
        //                     .then(function() {
        //                         window.location.href = "<?php echo site_url('pengaduan') ?>";
        //                     });
        //             }
        //         });
        //         return false;
        //     },
        //     rules: {
        //         //Form User
        //         nama: {
        //             required: true,
        //             minlength: 3

        //         },
        //         nik: {
        //             required: true,
        //             number: true
        //         },
        //         no_hp: {
        //             required: true,
        //             rangelength: [10, 13]
        //         },
        //         sasaran: {
        //             required: true
        //         },
        //         waktu: {
        //             required: true
        //         },
        //         tgl_pengaduan: {
        //             required: true
        //         },
        //         id_kecamatan: {
        //             required: true
        //         },
        //     },
        //     messages: {
        //         //user
        //         nama: {
        //             required: "Nama tidak boleh kosong",
        //             minlength: "Nama minimal 3 karakter"
        //         },
        //         nik: {
        //             required: "NIK tidak boleh kosong",
        //             number: "Nik harus berupa angka"
        //         },
        //         no_hp: {
        //             required: "Nomor Handphone tidak boleh kosong",
        //             rangelength: "Panjang minimal angka 10 karakter maksimal 13 karakter"
        //         },
        //         sasaran: {
        //             required: "Sasaran tidak boleh kosong"
        //         },
        //         waktu: {
        //             required: "Waktu tidak boleh kosong"
        //         },
        //         tgl_pengaduan: {
        //             required: "Isi tanggal pengaduan"
        //         },
        //         id_kecamatan: {
        //             required: "Pilih Kecamatan"
        //         },
        //     },
        //     highlight: function(element) {
        //         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        //     },
        //     unhighlight: function(element) {
        //         $(element).closest('.form-group').removeClass('has-error');
        //     }
        // });



    });
</script>


<?= $this->endSection() ?>