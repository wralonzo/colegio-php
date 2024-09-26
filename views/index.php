<?php
require './template/header.php';
if ($_SESSION['admin'] != 1) {
  header("Location: " . getBaseUrl() . "/views/noacceso.php");
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count">
          <div class="dash-counts">
            <h4 id="usuarios"></h4>
            <h5>Usuarios</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="user"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das1">
          <div class="dash-counts">
            <h4 id="estudiantes"></h4>
            <h5>Estudiantes</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="user-check"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das2">
          <div class="dash-counts">
            <h4 id="cursos"></h4>
            <h5>Cursos</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="file-text"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das3">
          <div class="dash-counts">
            <h4 id="notas"></h4>
            <h5>Notas</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="file"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
          <div
            class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Notas ingresadas por mes</h5>
            <div class="graph-sets">
              <ul>
                <li>
                  <span>Notas</span>
                </li>

              </ul>
            </div>
          </div>
          <div class="card-body">
            <div id="sales_charts"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require './template/footer.php';
?>

<script>

</script>
<script>
  fetch("<?= getBaseUrl() ?>/controllers/login.php?op=count", {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      $('#usuarios').append('<span>' + data.count + '</span>');
    });

  fetch("<?= getBaseUrl() ?>/controllers/estudiante.php?op=count", {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      $('#estudiantes').append('<span>' + data.count + '</span>');
    });
  fetch("<?= getBaseUrl() ?>/controllers/curso.php?op=count", {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      $('#cursos').append('<span>' + data.count + '</span>');
    });
  fetch("<?= getBaseUrl() ?>/controllers/nota.php?op=count", {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      $('#notas').append('<span>' + data.count + '</span>');
    });

  fetch("<?= getBaseUrl() ?>/controllers/nota.php?op=countyear", {
      method: 'GET',
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      var options = {
        series: [{
            name: "Notas",
            data: data
          },
          // {
          //   name: "Purchase",
          //   data: [-21, -54, -45, -35, -21, -54, -45, -35]
          // },
        ],
        colors: ["#28C76F", "#EA5455"],
        chart: {
          type: "bar",
          height: 300,
          stacked: true,
          zoom: {
            enabled: true
          },
        },
        responsive: [{
          breakpoint: 280,
          options: {
            legend: {
              position: "bottom",
              offsetY: 0
            }
          },
        }, ],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "20%",
            endingShape: "rounded"
          },
        },
        xaxis: {
          categories: [
            "ENERO",
            "FEBRERO",
            "MARZO",
            "ABRIL",
            "MAYO",
            "JUNIO",
            "JULIO",
            "AGOSTO",
            "SEPTIEMBRE",
            "OCTUBRE",
            "NOVIEMBRE",
            "DICIEMBRE",
          ],
        },
        legend: {
          position: "right",
          offsetY: 40
        },
        fill: {
          opacity: 1
        },
      };
      var chart = new ApexCharts(
        document.querySelector("#sales_charts"),
        options
      );
      chart.render();
    });
</script>
</body>

</html>