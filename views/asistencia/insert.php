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
        <h4>Agregar asistencia por grado</h4>
      </div>
    </div>
    <form name="formulario" id="formulario" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Selecciona el grado</label>
                <select name="idcurso" id="idcurso" class="select" required>
                </select>
              </div>
            </div>

            <input type="hidden" name="idCurso" id="idcurso">

            <div class="container">
              <table id="studentTable" border="1" class="table">
                <thead>
                  <tr id="tableHeaders">
                    <th>Nombre del Estudiante</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Guardar</button>
              <button type="button" class="btn btn-cancel me-2" id="printButton" c>Imprimir</button>
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

    // Escucha el cambio en el select
    $('#idcurso').on('change', function() {
      const selectedCurso = this.value;
      if (selectedCurso) {
        $('#idcurso').val(selectedCurso);
        const today = new Date().toISOString().substr(0, 10)
        fetch(`<?= getBaseUrl() ?>/controllers/curso.php?op=estudianteCurso&id=${selectedCurso}`, {
            method: 'GET',
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            const studentTableHeaders = $('#tableHeaders');
            const studentTableBody = $('#studentTable tbody');

            // Limpiar el contenido de la tabla antes de agregar nuevas asignaturas y estudiantes
            studentTableBody.empty(); // Limpiar el cuerpo de la tabla (filas)
            // studentTableHeaders.find("th:gt(0)").remove(); // Limpiar los encabezados excepto el primero (nombre del estudiante)

            let row = '';
            data.forEach(function(estudiante) {
              // Iniciar la fila con el nombre del estudiante y añadir el atributo 'data-estudiante-id' para capturar el ID
              let row = `<tr>
               <td data-estudiante-id="${estudiante.idestudiante}">${estudiante.nombres}</td>`;

              // Añadir un campo de entrada tipo 'date' para cada estudiante
              row += `<td data-estudiante-id="${estudiante.idestudiante}">
                <input class="form-control" type="date" value="<?= date('Y-m-d') ?>" name="input_${estudiante.idestudiante}" id="input_${estudiante.idestudiante}" />
              </td>`;

              // Añadir un campo 'select' para elegir el estado de asistencia
              row += `<td data-estudiante-id="${estudiante.idestudiante}">
                <select name="estado_${estudiante.idestudiante}" id="estado_${estudiante.idestudiante}" class="form-control" required>
                  <option value="Presente">Presente</option>
                  <option value="Permiso">Permiso</option>
                  <option value="Ausente">Ausente</option>
                </select>
              </td>`;
              row += `</tr>`;
              studentTableBody.append(row);
            });

          });; // Formato 'YYYY-MM-DD'
        // document.getElementById('input_${estudiante.idestudiante}').value = today;
      }
    });



    function guardaryeditarCurso(e) {
      e.preventDefault();
      const notas = [];
      const formData = new FormData();
      // Recorrer cada fila de la tabla
      var idCurso = $('#idcurso').val();
      const studentTableBody = document.querySelector('#studentTable tbody');
      studentTableBody.querySelectorAll('tr').forEach(function(row) {
        // Obtener el ID del estudiante desde el atributo 'data-estudiante-id'
        const estudianteId = row.querySelector('td[data-estudiante-id]').getAttribute('data-estudiante-id');

        // Obtener el valor de la fecha del input
        const fecha = row.querySelector(`input[name="input_${estudianteId}"]`).value;

        // Obtener el valor seleccionado del campo 'select'
        const asistencia = row.querySelector(`select[name="estado_${estudianteId}"]`).value;

        // Agregar los datos al FormData
        formData.append(`estudiantes[${estudianteId}][fecha]`, fecha);
        formData.append(`estudiantes[${estudianteId}][estado]`, asistencia);
        formData.append(`estudiantes[${estudianteId}][idcurso]`, idCurso);
      });

      console.log(notas);
      fetch('<?= getBaseUrl() ?>/controllers/asistencia.php?op=guardaryeditar', {
          method: 'POST',
          body: formData // Convertir el array de datos a JSON
        })
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
          }
          return response.json();
        })
        .then(result => {
          console.log('Datos guardados correctamente:', result);
          // Aquí puedes mostrar un mensaje de éxito
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Notas guardadas correctamente',
            showConfirmButton: false,
            timer: 1500
          });

          setTimeout(() => {
            $(location).attr("href", "<?= getBaseUrl() ?>/views/asistencia/");
          }, 2000);
        })
        .catch(error => {
          console.error('Error al guardar las notas:', error);
          // Mostrar mensaje de error
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar las notas.'
          });
        });
    }
  });


  function printTable() {
    const studentTable = document.getElementById('studentTable');

    // Clonar la tabla para modificarla
    const printTableClone = studentTable.cloneNode(true);

    // Obtener todos los inputs dentro de la tabla clonada
    const inputs = printTableClone.querySelectorAll('input');

    // Reemplazar cada input por su valor en la tabla clonada
    inputs.forEach(input => {
      const inputValue = input.value || ''; // Obtener el valor del input o cadena vacía si está vacío
      const textNode = document.createTextNode(inputValue); // Crear un nodo de texto con el valor del input
      input.parentNode.replaceChild(textNode, input); // Reemplazar el input por el nodo de texto
    });

    // Obtener el HTML de la tabla clonada ya modificada
    const printContents = printTableClone.outerHTML;

    // Abrir una nueva ventana para imprimir
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Imprimir</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents); // Añadir la tabla modificada en la nueva ventana
    printWindow.document.write('</body></html>');

    printWindow.document.close(); // Cerrar el documento
    printWindow.focus(); // Hacer foco en la nueva ventana
    printWindow.print(); // Activar el diálogo de impresión
    printWindow.close(); // Cerrar la ventana después de imprimir
  }

  document.getElementById('printButton').addEventListener('click', function() {
    printTable();
  });
</script>