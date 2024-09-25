<?php
require '../template/header.php';
if ($_SESSION['asignatura'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Agregar adjunto</h4>
        <h6>Crear nuevo adjunto</h6>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Descripcion</label>
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion" required></textarea>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label>Sube un archivo</label>
                <div class="image-upload image-upload-new">
                  <input type="file" name="imagen" />
                  <div class="image-uploads">
                    <img src="../../assets/img/icons/upload.svg" alt="img" />
                    <h4>Sube un archivo</h4>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Guardar</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>
<?php
require '../template/footer.php';
?>
<script>
  $(document).ready(function() {
    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault(); //No se activará la acción predeterminada del evento
      $("#btnGuardar").prop("disabled", true);
      var formData = new FormData($("#formulario")[0]);

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/adjunto.php?op=uploadFile",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          console.log('datos: ', datos);
          if (datos == 1) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Adjunto registrado',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/diario");
            }, 2000);
          } else {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo registrar',
              showConfirmButton: false,
              timer: 1500
            })
          }
        }

      });
    }
  });
</script>