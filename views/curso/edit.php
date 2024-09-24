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
        <h4>Editar Grados</h4>
        <h6>Actualizar Grados</h6>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="container">
        <div class="row">
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
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
$idcat = $_GET["id"];
?>

<script>
  $(document).ready(function() {
    var formData = new FormData();
    formData.append("id", Number(<?= $idcat ?>));
    fetch("<?= getBaseUrl() ?>/controllers/curso.php?op=mostrar", {
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
        $("#nombre").val(data.nombre);
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
        url: "<?= getBaseUrl() ?>/controllers/curso.php?op=guardaryeditar",
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
              $(location).attr("href", "<?= getBaseUrl() ?>/views/curso");
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