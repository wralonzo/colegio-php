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
        <h4>Agregar Notas por grado</h4>
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

            <div class="container">
              <table id="studentTable" border="1" class="table">
                <thead>
                  <tr id="tableHeaders">
                    <th>Nombre del Estudiante</th>
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

            fetch(`<?= getBaseUrl() ?>/controllers/curso.php?op=asignaturaCursos&id=${selectedCurso}`, {
                method: 'GET',
              })
              .then(response => {
                if (!response.ok) {
                  throw new Error(`HTTP error: ${response.status}`);
                }
                return response.json();
              })
              .then(asignaturas => {
                // Construir los encabezados de las asignaturas
                let headerHtml = '<th>Nombre del Estudiante</th>';
                asignaturas.forEach(function(asignatura) {
                  headerHtml += `<th>${asignatura.nombre}</th>`;
                });

                // Añadir los encabezados al thead
                studentTableHeaders.html(headerHtml);

                console.log(data);
                let row = '';
                data.forEach(function(estudiante) {
                  row = `<tr><td data-estudiante-id="${estudiante.idestudiante}">${estudiante.nombres}</td>`;

                  asignaturas.forEach(function(asignatura) {
                    row += `<td><input class="form-control" type="text" name="input_${estudiante.idestudiante}_${asignatura.idasignatura}" id="input_${estudiante.idestudiante}_${asignatura.idasignatura}" placeholder="Ingrese nota" /></td>`;
                  });

                  row += `</tr>`;
                  studentTableBody.append(row);
                });
                // Agregar la fila a la tabla
              })
              .catch(error => {
                console.error('Error fetching data:', error);
              });
          });
      }
    });



    function guardaryeditarCurso(e) {
      e.preventDefault();

      const notas = [];
      const formData = new FormData();
      // Recorrer cada fila de la tabla
      $('#studentTable tbody tr').each(function() {
        const row = $(this);
        const estudianteId = row.find('td:first').data('estudiante-id'); // Obtener ID del estudiante

        row.find('input').each(function() {
          const input = $(this);
          const asignaturaId = input.attr('id').split('_')[2]; // Obtener ID de la asignatura
          const nota = input.val(); // Obtener la nota ingresada

          // Agregar las notas al FormData
          formData.append(`notas[${estudianteId}][${asignaturaId}]`, nota);
        });
      });

      console.log(notas);
      fetch('<?= getBaseUrl() ?>/controllers/nota.php?op=guardaryeditar', {
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
            $(location).attr("href", "<?= getBaseUrl() ?>/views/notas");
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