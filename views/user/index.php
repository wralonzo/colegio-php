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
				<h4>Listado de usuarios</h4>
				<h6>Gestionar usuarios</h6>
			</div>
			<div class="page-btn">
				<a href="insert.php" class="btn btn-added"><img src="../../assets/img/icons/plus.svg" class="me-2" alt="img" />
					Agregar usuario</a>
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
								<a
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="pdf"><img src="../../assets/img/icons/pdf.svg" alt="img" /></a>
							</li>
							<li>
								<a
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="excel"><img src="../../assets/img/icons/excel.svg" alt="img" /></a>
							</li>
							<li>
								<a
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="print"><img src="../../assets/img/icons/printer.svg" alt="img" /></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="">
					<table class="table tabledata" id="wordset">
						<thead>
							<tr>
								<th>NOMBRE</th>
								<th>TELEFONO</th>
								<th>E-MAIL</th>
								<th>USER</th>
								<th>Imagen</th>
								<th>ACCIONES</th>
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
require '../template/footer.php';
?>

<script type="text/javascript">
	function delayedFunction() {
		$(location).attr("href", "<?= getBaseUrl() ?>/views/user");
	}

	function desactivarUsuario(id) {
		var formData = new FormData();
		formData.append("idusuario", id);
		$.ajax({
			url: "<?= getBaseUrl() ?>/controllers/login.php?op=desactivar",
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
						title: 'Usuario eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(delayedFunction, 2000);

				} else {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Usuario no eliminado',
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	}
	$(document).ready(function() {
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
				url: '<?= getBaseUrl() ?>/controllers/login.php?op=listar',
				type: "get",
				dataType: "json",
				error: function(e) {
					console.log(e.responseText);
				}
			},
		});

		function activar(id) {
			$.ajax({
				url: "<?= getBaseUrl() ?>/controllers/login.php?op=desactivar",
				type: "POST",
				data: {
					idusuario: id
				},
				contentType: false,
				processData: false,
				success: function(datos) {
					if (datos == 1) {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Usuario eliminado',
							showConfirmButton: false,
							timer: 1500
						});
						$(location).attr("href", "<?= getBaseUrl() ?>/views/user");
					} else {
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Usuario no eliminado',
							showConfirmButton: false,
							timer: 1500
						});
					}
				}

			});
		}
	});
</script>

</body>

</html>