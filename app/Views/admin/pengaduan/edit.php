<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit &mdash; Welcome Admin</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('admin/pengaduan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Edit Pengaduan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Edit Data Pengajuan</h4>
            </div>
            <div class="card-body col-md-6">
                <?php $validation = \Config\Services::validation(); ?>
                <form onsubmit="return false" id="form" method="post" autocomplete="off" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_pengaduan" id="id_pengaduan" value="<?= $pengaduan->id_pengaduan; ?>">

                    <div class="form-group">
                        <label for="Nama">Nama *</label>
                        <input type="text" class="form-control" id="nama" value="<?= $pengaduan->nama; ?>" placeholder="Masukkan Nama" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="NIK">NIK *</label>
                        <input type="number" class="form-control" id="nik" value="<?= $pengaduan->nik ?>" placeholder="Masukkan NIK" name="nik" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Tolong isi nik terlebih dahulu.</div>
                    </div>

                    <div class="form-group">
                        <label for="NIK">Nomor Handphone *</label>
                        <input type="number" class="form-control" id="nomor_hp" value="<?= $pengaduan->nomor_hp ?>" placeholder="Masukkan Nomor Handphone" name="nomor_hp" required>
                    </div>

                    <div class="form-group">
                        <label for="Jenis_Aduan">Jenis Aduan *</label>
                        <div class="invalid-feedback">
                            <p id="jenis_error"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="radio" name="jenis_aduan" id="jenis_aduan" value="Pengamanan" <?= $pengaduan->jenis_aduan == 'Pengamanan' ? 'checked' : null ?>>
                            Pengamanan
                        </label>
                        <label>
                            <input type="radio" name="jenis_aduan" id="jenis_aduan" value="Patroli" <?= $pengaduan->jenis_aduan == 'Patroli' ? 'checked' : null ?>>
                            Patroli
                        </label>
                        <label>
                            <input type="radio" name="jenis_aduan" id="jenis_aduan" value="Penanganan Orang Terlantar" <?= $pengaduan->jenis_aduan == 'Penanganan Orang Terlantar' ? 'checked' : null ?>>
                            Penanganan Orang Terlantar
                        </label>
                        <label>
                            <input type="radio" name="jenis_aduan" id="jenis_aduan" value="Penanganan ODGJ" <?= $pengaduan->jenis_aduan == 'Penanganan ODGJ' ? 'checked' : null ?>>
                            Penanganan ODGJ
                        </label>

                        <label for="Jenis_Aduan" class="error">
                            <p id="jenis_aduan_error"></p>
                        </label>
                    </div>


                    <div class="form-group">
                        <label for="Sasaran">Sasaran *</label>
                        <textarea class="form-control" id="sasaran" placeholder="Masukkan Sasaran" name="sasaran" required><?= $pengaduan->sasaran ?></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Tolong isi sasaran terlebih dahulu.</div>
                    </div>

                    <div class="form-group">
                        <label for="Waktu">Waktu Pengaduan *</label>
                        <input type="time" class="form-control" id="waktu" value="<?= $pengaduan->waktu ?>" placeholder="Masukkan Waktu Pengaduan" name="waktu" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Tolong isi waktu terlebih dahulu.</div>
                    </div>

                    <div class="form-group">
                        <label for="Tanggal">Tanggal Pengaduan *</label>
                        <input type="date" class="form-control" id="tgl_pengaduan" value="<?= $pengaduan->tgl_pengaduan ?>" placeholder="Masukkan Tanggal Pengaduan" name="tgl_pengaduan" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Tolong isi waktu terlebih dahulu.</div>
                    </div>

                    <div class="form-group">
                        <label for="Lokasi">lokasi *</label>
                        <textarea class="form-control" id="lokasi" placeholder="Masukkan Lokasi" name="lokasi" required><?= $pengaduan->lokasi ?></textarea>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Tolong isi lokasi terlebih dahulu.</div>
                    </div>

                    <div class="form-group">
                        <label>Kecamatan *</label>
                        <!-- <div class="selectric-wrapper selectric-form-control selectric-selectric selectric-below">
                            <div class="selectric-hide-select"><select class="form-control selectric" tabindex="-1" name="id_kecamatan" id="id_kecamatan"> -->
                        <select name="id_kecamatan" class="form-control" id="id_kecamatan" required>
                            <option value="" hidden> </option>
                            <?php foreach ($kecamatan as $key => $value) : ?>
                                <option value="<?= $value->id_kecamatan ?>" <?= $pengaduan->id_kecamatan == $value->id_kecamatan ? 'selected' : null ?>>
                                    <?= $value->keterangan ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <p id="lokasi_error"></p>
                        </div>
                    </div>
            </div>


        </div>


        <div>
            <button type="submit" class="btn btn-success" id="btn-update">
                <i class="fas fa-paper-plane" id="notloading"></i>
                <i class="loading-icon fa fa-spinner fa-spin" hidden></i>
                <span class="btn-text">Update</span>
            </button>
            <button type="reset" class="btn btn-secondary">Batal</i>

            </button>
        </div>
        </form>
    </div>
    </div>

    </div>
</section>
<script>
    // Disable form submissions if there are invalid fields
    // (function() {
    //     alert('tes');
    //     'use strict';
    //     window.addEventListener('load', function() {
    //         alert('tes');
    //         // Get the forms we want to add validation styles to
    //         var forms = document.getElementsByClassName('needs-validation');
    //         // Loop over them and prevent submission
    //         var validation = Array.prototype.filter.call(forms, function(form) {
    //             form.addEventListener('submit', function(event) {
    //                 if (form.checkValidity() === false) {
    //                     alert('tes');
    //                     event.preventDefault();
    //                     // event.stopPropagation();
    //                 }
    //                 form.classList.add('was-validated');
    //             }, false);
    //         });
    //     }, false);
    // })();

    // $(document).ready(function() {

    $(document).ready(function() {

        //     $("#update").click(function() {
        var id_pengaduan = $('#id_pengaduan').val();
        var nama = $('#nama').val();
        var nik = $('#nik').val();
        var nomor_hp = $('#nomor_hp').val();
        var jenis_aduan = $('#id_jenis').val();
        var sasaran = $('#sasaran').val();
        var waktu = $('#waktu').val();
        var lokasi =$('#lokasi').val();
        var tgl_pengaduan = $('#tgl_pengaduan').val();
        var kecamatan = $('#id_kecamatan').val();



        //         $.ajax({

        //             url: "<?php echo site_url('pengaduan/update') ?>/" + id_pengaduan,
        //             type: "POST",
        //             data: $('#form').serialize(),

        //             success: function(response) {

        //                 if (response) {

        //                     Swal.fire({
        //                             icon: 'success',
        //                             title: 'Data Berhasil diupdate!',
        //                             text: 'Anda akan di arahkan dalam 3 Detik',
        //                             timer: 3000,
        //                             showCancelButton: false,
        //                             showConfirmButton: false
        //                         })
        //                         .then(function() {
        //                             window.location.href = "<?php echo site_url('pengaduan') ?>";
        //                         });

        //                 } else {

        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: 'Data belum berhasil diupdate!',
        //                         text: 'silahkan coba lagi!'
        //                     });


        //                 }

        //                 console.log(response);

        //             },

        //             error: function(response) {

        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Opps!',
        //                     text: 'server error!'
        //                 });

        //                 console.log(response);

        //             }

        //         });



        //     });

        // });

        validator = $("#form").validate({
            submitHandler: function(form) {
                // $('#notloading').attr('hidden', true);
                var id_pengaduan = $('#id_pengaduan').val();
                // var nama = $('#nama').val();
                // var nik = $('#nik').val();
                // var nomor_hp = $('#nomor_hp').val();
                // var jenis_aduan = $('#id_jenis').val();
                // var sasaran = $('#sasaran').val();
                // var waktu = $('#waktu').val();
                // var tgl_pengaduan = $('#tgl_pengaduan').val();
                // var lokasi = $('#lokasi').val();

                $('.loading-icon').removeAttr('hidden');
                $('#btn-update').attr('disabled', 'disabled');
                $('.btn-text').html('Loading . . .');

                // var toast_text;
                var url = "<?php echo site_url('admin/pengaduan/update') ?>/" + id_pengaduan;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(form).serialize(),
                    success: function(response) {
                        $('[nama=<?= csrf_token() ?>]').val(response.csrf);
                        Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil diupdate!',
                                text: 'Anda akan di arahkan dalam 3 Detik',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: true
                            })
                            .then(function() {
                                window.location.href = "<?php echo site_url('admin/pengaduan') ?>";
                            });
                    }
                });
                return false;
            },
            rules: {
                //Form User
                nama: {
                    required: true,
                    minlength: 3

                },
                nik: {
                    required: true,
                    number: true
                },
                nomor_hp: {
                    required: true,
                    rangelength: [10, 13]
                },
                sasaran: {
                    required: true
                },
                waktu: {
                    required: true
                },
                tgl_pengaduan: {
                    required: true
                },
                lokasi:{
                    required:true
                },
                id_kecamatan: {
                    required: true
                },
            },
            messages: {
                //user
                nama: {
                    required: "Nama tidak boleh kosong",
                    minlength: "Nama minimal 3 karakter"
                },
                nik: {
                    required: "NIK tidak boleh kosong",
                    number: "Nik harus berupa angka"
                },
                nomor_hp: {
                    required: "Nomor Handphone tidak boleh kosong/isi dengan format nomor indonesia",
                    rangelength: "Panjang minimal angka 10 karakter maksimal 13 karakter"
                },
                sasaran: {
                    required: "Sasaran tidak boleh kosong"
                },
                waktu: {
                    required: "Waktu tidak boleh kosong"
                },
                tgl_pengaduan: {
                    required: "Isi tanggal pengaduan"
                },
                lokasi: {
                    required:"Lokasi tidak boleh kosong"
                },
                id_kecamatan: {
                    required: "Pilih Kecamatan"
                },
            },
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            }
        });



    });
</script>
<?= $this->endSection() ?>