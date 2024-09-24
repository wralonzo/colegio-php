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
        <h4>Editar curso</h4>
        <h6>Actualizar curso</h6>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
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
    </form>
  </div>
</div>
<?php
require '../template/footer.php';
$idcat = $_GET["id"];
?>

<script>
  $(document).ready(function() {
    var formData = new FormData();
    formData.append("id", Number(<?= $idcat ?>));
    fetch("<?= getBaseUrl() ?>/controllers/estudiante.php?op=mostrar", {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Cargando...',
          showConfirmButton: false,
          timer: 1500
        });
        $("#nombres").val(data.nombres);
        $("#direccion").val(data.direccion);
        $("#numero").val(data.numero);
        $("#edad").val(data.edad)
        $("#papeleria").val(data.papeleria);
      });

    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })

    function guardaryeditar(e) {
      console.log('funcion guardaryeditar');
      e.preventDefault(); //No se activará la acción predeterminada del evento
      $("#btnGuardar").prop("disabled", true);
      var formData = new FormData($("#formulario")[0]);
      formData.append("id", Number(<?= $idcat ?>));

      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/estudiante.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
          console.log('datos: ', datos);
          if (datos == 3) {
            console.log(datos);
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Información actualizada',
              showConfirmButton: false,
              timer: 1500
            })
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/estudiante");
            }, 2000);
          } else {
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

</body>

</html>