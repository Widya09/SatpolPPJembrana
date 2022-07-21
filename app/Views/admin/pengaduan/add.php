<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create &mdash; Welcome Admin</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('admin/pengaduan') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create Pengaduan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Data Pengaduan</h4>
            </div>
            <div class="card-body col-md-6">
                <?php $validation = \Config\Services::validation(); ?>
                <form onsubmit="return false" id="form" method="post" autocomplete="off" class="needs-validation" novalidate>
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Nama">Nama *</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" autofocus required>
                        <div class="invalid-feedback">
                            <p id="nama_error"></p>
                        </div>
                        <!-- <div class="valid-feedback">Nama sudah terisi.</div> -->
                    </div>

                    <div class="form-group">
                        <label for="NIK">NIK *</label>
                        <input type="number" class="form-control" id="nik" placeholder="Masukkan NIK" name="nik" required>
                        <div class="invalid-feedback">
                            <p id="nik_error"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Nomor Handphone">Nomor Handphone *</label>

                        <input type="number" class="form-control" id="nomor_hp" placeholder="Masukkan Nomor Handphone 08" name="nomor_hp" required>
                        <div class="invalid-feedback">
                            <p id="nomor_hp_error"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Jenis_Aduan">Jenis Aduan *</label>
                        <div class="invalid-feedback">
                            <p id="jenis_error"></p>
                        </div>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_aduan" id="jenis_aduan" value="Patroli">Patroli
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_aduan" id="jenis_aduan" value="Pengamanan">Pengamanan
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_aduan" id="jenis_aduan" value="Penanganan Orang Terlantar">Penanganan Orang Terlantar
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="jenis_aduan" id="jenis_aduan" value="Penanganan ODGJ">Penanganan ODGJ
                        </label>
                        <label for="Jenis_Aduan" class="error">
                            <p id="jenis_aduan_error"></p>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="Sasaran">Sasaran *</label>
                        <textarea class="form-control" id="sasaran" placeholder="Masukkan Sasaran" name="sasaran" required></textarea>
                        <div class="invalid-feedback">
                            <p id="sasaran_error"></p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="Waktu">Waktu Pengaduan *</label>
                        <input type="time" class="form-control" id="waktu" placeholder="Masukkan Waktu Pengaduan" name="waktu" required>
                        <div class="invalid-feedback">
                            <p id="waktu_error"></p>
                        </div>
                    </div>

                    <?php
                    $date = date('Y-m-d');
                    ?>
                    <div class="form-group">
                        <label for="Tanggal">Tanggal Pengaduan *</label>
                        <input type="date" class="form-control" id="tgl_pengaduan" placeholder="Masukkan Tanggal Pengaduan" value="<?= $date; ?>" name="tgl_pengaduan" required>
                        <div class="invalid-feedback">
                            <p id="tanggal_error"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Lokasi">Lokasi Kejadian *</label>
                        <textarea class="form-control" id="lokasi" placeholder="Masukkan Lokasi" name="lokasi" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Kecamatan *</label>
                        <!-- <div class="selectric-wrapper selectric-form-control selectric-selectric selectric-below">
                            <div class="selectric-hide-select"><select class="form-control selectric" tabindex="-1" name="id_kecamatan" id="id_kecamatan"> -->
                        <select name="id_kecamatan" class="form-control" id="id_kecamatan" required>
                            <option value="" hidden> </option>
                            <?php foreach ($kecamatan as $key => $value) : ?>
                                <option value="<?= $value->id_kecamatan ?>"><?= $value->keterangan ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <p id="lokasi_error"></p>
                        </div>
                    </div>
            </div>
        </div>



        <div>
            <!-- <button type="submit" class="btn btn-success" id="simpan"><i class="fas fa-paper-plane">Simpan</i></button> -->

            <button type="submit" class="btn btn-success" id="btn-submit">
                <i class="fas fa-paper-plane" id="notloading"></i>
                <i class="loading-icon fa fa-spinner fa-spin" hidden></i>
                <span class="btn-text">Simpan</span>
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
    $(document).ready(function() {

        validator = $("#form").validate({
            submitHandler: function(form) {
                $('#notloading').attr('hidden', true);

                $('.loading-icon').removeAttr('hidden');
                $('#btn-submit').attr('disabled', 'disabled');
                $('.btn-text').html('Loading . . .');

                // var toast_text;
                var url = "<?php echo site_url('admin/pengaduan') ?>";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(form).serialize(),
                    success: function(response) {
                        $('[name=<?= csrf_token() ?>]').val(response.csrf);
                        Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil disimpan!',
                                text: 'Anda akan di arahkan dalam 3 Detik',
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false
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
                    // matches:"[0-9\-\(\)\s]+",
                    required: true,
                    rangelength: [10, 13]
                },
                jenis_aduan: {
                    required: true,
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
                lokasi: {
                    required: true
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
                    required: "Nomor Handphone yang harus dimasukkan harus 08",
                    rangelength: "Panjang minimal angka 10 karakter maksimal 13 karakter"
                },
                jenis_aduan: {
                    required: "Pilih Jenis Aduan"
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
                    required: "Lokasi tidak boleh kosong"
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