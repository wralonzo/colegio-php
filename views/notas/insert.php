<?php
require '../template/header.php';
if ($_SESSION['estudiante'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Agregar estudiante</h4>
        <h6>Crear un nuevo estudiante</h6>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="nombre" id="nombres" required />
              </div>
              <div class="form-group">
                <label>Numero de telefono</label>
                <input type="text" name="numero" id="numero" required />
              </div>
              <div class="form-group">
                <label>Años de edad</label>
                <input type="text" name="edad" id="edad" placeholder="ingrese un numero entero" required />
              </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                <label>Direccion</label>
                <input id="direccion" name="direccion" type="text" required />
              </div>
              <div class="form-group">
                <label>Estado de la papeledia</label>
                <select name="papeleria" id="papeleeia" class="select" required>
                  <option value="Completo">Completo</option>
                  <option value="Incompleto">Incompleto</option>
                  <option value="Pendiente">Pendiente</option>
                </select>
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
    $.post("<?= getBaseUrl() ?>/controllers/estudiante.php?op=permisos&id=", function(r) {
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
        url: "<?= getBaseUrl() ?>/controllers/estudiante.php?op=guardaryeditar",
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
              title: 'Estudiante registrado',
              showConfirmButton: false,
              timer: 1500
            });
            $("#btnGuardar").prop("disabled", false);
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/estudiante");
            }, 3000);
          } else if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Estudiante actualizado',
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