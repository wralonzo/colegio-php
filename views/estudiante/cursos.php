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
				<h4>Listado de cursos del estudiante</h4>
				<h6>Gestionar cursos del estudiante</h6>
			</div>
			<div class="page-btn">
				<a href="asingar.php?id=<?= $_GET["id"] ?>" class="btn btn-added"><img src="../../assets/img/icons/plus.svg" class="me-2" alt="img" />
					Agregar </a>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="table-top">
					<div class="search-set">
						<div class="search-path">
							<a class="btn btn-filter" id="filter_search">
								<img src="../../assets/img/icons/filter.svg" alt="img" />
								<span><img src="../../assets/img/icons/closes.svg" alt="img" /></span>
							</a>
						</div>
						<div class="search-input">
							<a class="btn btn-searchset"><img src="../../assets/img/icons/search-white.svg" alt="img" /></a>
						</div>
					</div>
					<div class="wordset">
						<ul>
							<li>
								<a id="printButton"
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="print"><img src="../../assets/img/icons/printer.svg" alt="img" /></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="">
					<table id="tabledata" class="table tabledata">
						<thead>
							<tr>
								<th>Id</th>
								<th>Grado</th>
								<th>Estudiante</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$idRegistro = $_GET["id"];
require '../template/footer.php';
?>

<script type="text/javascript">
	function delayedFunction() {
		$(location).attr("href", "<?= getBaseUrl() ?>/views/estudiante/cursos.php?id=<?= $_GET["id"] ?>");
	}

	function desactivar(id) {
		var formData = new FormData();
		formData.append("idcursoestudiante", id);
		$.ajax({
			url: "<?= getBaseUrl() ?>/controllers/estudiante.php?op=eliminarAsignar",
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
						title: 'Curso eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(delayedFunction, 2000);

				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Curso no eliminada',
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	}
	$(document).ready(function() {
		var formData = new FormData();
		formData.append("id", <?php echo $idRegistro ?>);
		console.log(formData)
		$(".tabledata").DataTable({
			bFilter: true,
			sDom: "fBtlpi",
			pagingType: "numbers",
			ordering: true,
			language: {
				search: " ",
				sLengthMenu: "_MENU_",
				searchPlaceholder: "Search...",
				info: "_START_ - _END_ of _TOTAL_ items",
			},
			initComplete: (settings, json) => {
				$(".dataTables_filter").appendTo("#tableSearch");
				$(".dataTables_filter").appendTo(".search-input");
			},

			"ajax": {
				url: '<?= getBaseUrl() ?>/controllers/estudiante.php?op=listarcursos&id=<?php echo $idRegistro ?>',
				type: "GET",
				body: formData,
				error: function(e) {
					console.log(e.responseText);
				}
			},
		});
	});

	function printTable() {
		const studentTable = document.getElementById('tabledata');

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

		// Centramos el contenido de todas las celdas
		const cells = printTableClone.querySelectorAll('td, th'); // Seleccionar celdas de la tabla clonada
		cells.forEach(cell => {
			cell.style.textAlign = 'center'; // Centrar el contenido de las celdas
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

	// Añadir el evento click al botón de imprimir
	document.getElementById('printButton').addEventListener('click', function() {
		printTable();
	});
</script>

</body>

</html>