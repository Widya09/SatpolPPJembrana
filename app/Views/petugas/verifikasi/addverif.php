<?= $this->extend('layout_petugas/default_t') ?>

<?= $this->section('title') ?>
<title>Pengaduan &mdash; Welcome Petugas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('petugas/verifikasi') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Pengaduan</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Konfirmasi Data Pengajuan</h4>
            </div>
    <div class="card-body col-md-6">
      <form onsubmit="return false" id="form" method="post" autocomplete="off" class="needs-validation" novalidate enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id_pengaduan" id="id_pengaduan" value="<?= $pengaduan->id_pengaduan ?>">
        <div class="form-group">
          <label for="Temuan">Temuan *</label>
          <textarea class="form-control" id="temuan" placeholder="Masukan Temuan" name="temuan" required></textarea>
        </div>

        <div class="form-group">
          <label for="Tindakan">Tindakan *</label>
          <textarea class="form-control" id="tindakan" placeholder="Masukkan Tindakan" name="tindakan" required></textarea>
        </div>

        <div class="form-group">
          <label for="Keterangan">Keterangan *</label>
          <textarea class="form-control" id="keterangan" placeholder="Masukkan Keterangan" name="keterangan" required></textarea>
        </div>

        <div class="form-group">
          <label for="Upload Foto">Upload Foto *</label>
          <div class="col-sm-2">
            <img src="/img/default.jpg" id="previewImg" class="img-thumbnail img-preview">
          </div>
          <input type="file" class="form-control" id="upload_foto" name="upload_foto" onchange="previewFile(this)">
        </div>


        <div>
          <button type="submit" class="btn btn-success" id="verifikasi"><i class="fas fa-paper-plane mb-2">Verifikasi Data</i></button>
          <button type="reset" class="btn btn-secondary">Batal</i></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    var id_pengaduan = $('#id_pengaduan').val();

    validator = $("#form").validate({
      submitHandler: function(form) {
        $('#notloading').attr('hidden', true);

        $('.loading-icon').removeAttr('hidden');
        $('#verifikasi').attr('disabled', 'disabled');
        $('.btn-text').html('Loading . . .');

        // var toast_text;
        var url = "<?php echo site_url('petugas/verifikasi/terverif') ?>/" + id_pengaduan

        var formData = new FormData($("#form")[0]);
        // var imgFile = document.getElementById('upload_foto').files[0];
        var file = $('#upload_foto').get.files;
        console.log(file);
        // formData.append("#upload_foto", imgFile);
        $.ajax({
          url: url,
          type: "POST",
          // data: $(form).serialize(),
          // dataType: "JSON",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            $('[name=<?= csrf_token() ?>]').val(response.csrf);
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil diverifikasi!',
                text: 'Anda akan di arahkan dalam 3 Detik',
                timer: 3000,
                showCancelButton: false,
                showConfirmButton: false
              })
              .then(function() {
                window.location.href = "<?php echo site_url('petugas/verifikasi') ?>";
                // echo "hay";
              });
          }
        });
        return false;
      },
      rules: {
        //Form User
        temuan: {
          required: true


        },
        tindakan: {
          required: true

        },
        keterangan: {
          required: true

        },
        upload_foto: {
          required: true
        },
      },
      messages: {
        //user
        temuan: {
          required: "temuan tidak boleh kosong"

        },
        tindakan: {
          required: "tindakan tidak boleh kosong"
        },
        keterangan: {
          required: "Keterangan tidak boleh kosong"

        },
        upload_foto: {
          required: "Upload Foto tidak boleh kosong"
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

  function previewFile(input) {
    var file = $('#upload_foto').get(0).files[0];


    if (file) {

      var reader = new FileReader();

      reader.onload = function() {
        $("#previewImg").attr("src", reader.result);
      }

      reader.readAsDataURL(file);
      console.log(file.name);
    }
  }
</script>
<?= $this->endSection() ?>