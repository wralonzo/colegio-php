<?php
require '../template/header.php';
if ($_SESSION['user'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Agregar asignatura</h4>
        <h6>Crear una nueva Area de asignacion</h6>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Nombre</label>
              <input type="hidden" name="idusuario" id="idusuario">
              <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Teléfono</label>
              <input type="number" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>E-mail</label>
              <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Usuario</label>
              <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Usuario" required>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Rol</label>
              <select name="rol" id="rol" class="form-control">
                <option selected>Seleccione una rol</option>
                <option value="1">Admin</option>
                <option value="2">Maestro</option>
                <option value="3">Estudiante</option>
              </select>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Contraseña</label>
              <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Contraseña" required>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Permisos</label>
              <div id="permisos">

              </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label> Foto de pefil</label>
                <div class="image-upload image-upload-new">
                  <input type="file" name="imagen" />
                  <div class="image-uploads">
                    <img src="../../assets/img/icons/upload.svg" alt="img" />
                    <h4>Sube un archivo</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="center-text text-center container">
              <button class="btn btn-primary mx-4" type="submit" id="btnGuardar"><i class="now-ui-icons arrows-1_minimal-right"></i> Guardar</button>
              <!-- <button class="btn btn-danger mx-4" onclick="cancelarform()" type="button"><i class="now-ui-icons ui-1_simple-remove"></i> Cancelar</button> -->
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
    $.post("<?= getBaseUrl() ?>/controllers/login.php?op=permisos&id=", function(r) {
      $("#permisos").html(r);
    });

    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault();
      var formData = new FormData($("#formulario")[0]);

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/login.php?op=guardaryeditar",
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
              title: 'Usuario registrado',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            $(location).attr("href", "<?= getBaseUrl() ?>/views/user");
          } else if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Usuario actualizado',
              showConfirmButton: false,
              timer: 1500
            })
          } else if (datos == 2) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo registrar',
              showConfirmButton: false,
              timer: 1500
            })
          } else if (datos == 4) {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'No se pudo actualizar',
              showConfirmButton: false,
              timer: 1500
            })
          }
        }

      });
    }
  });
</script>