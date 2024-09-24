<?php
require '../template/header.php';
if ($_SESSION['curso'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Agregar Cursos</h4>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Selecciona el curso</label>
                <select name="idcurso" id="idcurso" class="select" required>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Guardar</button>
              <a href="<?= getBaseUrl() ?>/views/curso/asignatura.php?id=<?= $_GET["id"] ?>" class="btn btn-cancel">Cancelar</a>
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
      guardaryeditarCurso(e);
    })

    fetch("<?= getBaseUrl() ?>/controllers/curso.php?op=all", {
        method: 'GET',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`HTTP error: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        const selectElement = document.getElementById('idcurso');
        selectElement.innerHTML = '<option value="">Selecciona una opción</option>';
        data.forEach(item => {
          const option = document.createElement('option'); // Cambiado de 'idasignatura' a 'option'
          option.value = item.idcurso; // El valor que se envía al seleccionar
          option.textContent = item.nombre; // Lo que se muestra en el select
          selectElement.appendChild(option); // Agregar la opción al select
        });

      });

    $("#formulario").on("submit", function(e) {
      guardaryeditar(e);
    })


    function guardaryeditarCurso(e) {
      e.preventDefault();
      var formData = new FormData($("#formulario")[0]);
      formData.append("id", Number(<?= $_GET['id'] ?>));
      $.ajax({
        url: "<?= getBaseUrl() ?>/controllers/estudiante.php?op=asingar",
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
              title: 'curso registrado',
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(() => {
              $(location).attr("href", "<?= getBaseUrl() ?>/views/estudiante/cursos.php?id=<?= $_GET["id"] ?>");
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