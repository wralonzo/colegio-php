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
            <h4>100</h4>
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
            <h4>100</h4>
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
            <h4>100</h4>
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
            <h4>105</h4>
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
            <h5 class="card-title mb-0">Notas por cursos</h5>
            <div class="graph-sets">
              <ul>
                <li>
                  <span>Sales</span>
                </li>
                <li>
                  <span>Purchase</span>
                </li>
              </ul>
              <div class="dropdown">
                <button
                  class="btn btn-white btn-sm dropdown-toggle"
                  type="button"
                  id="dropdownMenuButton"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">
                  2022
                  <img
                    src="<?= getBaseUrl() ?>/assets/img/icons/dropdown.svg"
                    alt="img"
                    class="ms-2" />
                </button>
                <ul
                  class="dropdown-menu"
                  aria-labelledby="dropdownMenuButton">
                  <li>
                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="sales_charts"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="card mb-0">
      <div class="card-body">
        <h4 class="card-title">Expired Products</h4>
        <div class="table-responsive dataview">
          <table class="table datatable">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Brand Name</th>
                <th>Category Name</th>
                <th>Expiry Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><a href="javascript:void(0);">IT0001</a></td>
                <td class="productimgname">
                  <a class="product-img" href="productlist.html">
                    <img
                      src="assets/img/product/product2.jpg"
                      alt="product" />
                  </a>
                  <a href="productlist.html">Orange</a>
                </td>
                <td>N/D</td>
                <td>Fruits</td>
                <td>12-12-2022</td>
              </tr>
              <tr>
                <td>2</td>
                <td><a href="javascript:void(0);">IT0002</a></td>
                <td class="productimgname">
                  <a class="product-img" href="productlist.html">
                    <img
                      src="assets/img/product/product3.jpg"
                      alt="product" />
                  </a>
                  <a href="productlist.html">Pineapple</a>
                </td>
                <td>N/D</td>
                <td>Fruits</td>
                <td>25-11-2022</td>
              </tr>
              <tr>
                <td>3</td>
                <td><a href="javascript:void(0);">IT0003</a></td>
                <td class="productimgname">
                  <a class="product-img" href="productlist.html">
                    <img
                      src="assets/img/product/product4.jpg"
                      alt="product" />
                  </a>
                  <a href="productlist.html">Stawberry</a>
                </td>
                <td>N/D</td>
                <td>Fruits</td>
                <td>19-11-2022</td>
              </tr>
              <tr>
                <td>4</td>
                <td><a href="javascript:void(0);">IT0004</a></td>
                <td class="productimgname">
                  <a class="product-img" href="productlist.html">
                    <img
                      src="assets/img/product/product5.jpg"
                      alt="product" />
                  </a>
                  <a href="productlist.html">Avocat</a>
                </td>
                <td>N/D</td>
                <td>Fruits</td>
                <td>20-11-2022</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->
  </div>
</div>
<?php
require './template/footer.php';
?>

<script>
  $(document).ready(function() {
    demo = {
      initPickColor: function() {
        $(".pick-class-label").click(function() {
          var new_class = $(this).attr("new-class");
          var old_class = $("#display-buttons").attr("data-class");
          var display_div = $("#display-buttons");
          if (display_div.length) {
            var display_buttons = display_div.find(".btn");
            display_buttons.removeClass(old_class);
            display_buttons.addClass(new_class);
            display_div.attr("data-class", new_class);
          }
        });
      },

      initDocChart: function() {
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: true,
          scales: {
            yAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };
      },

      initDashboardPageCharts: function() {
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: 1,
          scales: {
            yAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };

        gradientChartOptionsConfigurationWithNumbersAndGrid = {
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          responsive: true,
          scales: {
            yAxes: [{
              gridLines: 0,
              gridLines: {
                zeroLineColor: "transparent",
                drawBorder: false,
              },
            }, ],
            xAxes: [{
              display: 0,
              gridLines: 0,
              ticks: {
                display: false,
              },
              gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false,
              },
            }, ],
          },
          layout: {
            padding: {
              left: 0,
              right: 0,
              top: 15,
              bottom: 15,
            },
          },
        };

        var ctx = document.getElementById("bigDashboardChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, "#80b6f4");
        gradientStroke.addColorStop(1, chartColor);

        var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
        var myChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: [
              "JAN",
              "FEB",
              "MAR",
              "APR",
              "MAY",
              "JUN",
              "JUL",
              "AUG",
              "SEP",
              "OCT",
              "NOV",
              "DEC",
            ],
            datasets: [{
              label: "Data",
              borderColor: chartColor,
              pointBorderColor: chartColor,
              pointBackgroundColor: "#1e3d60",
              pointHoverBackgroundColor: "#1e3d60",
              pointHoverBorderColor: chartColor,
              pointBorderWidth: 1,
              pointHoverRadius: 7,
              pointHoverBorderWidth: 2,
              pointRadius: 5,
              fill: true,
              backgroundColor: gradientFill,
              borderWidth: 2,
              data: [50, 150, 100, 190, 130, 90, 150, 160, 120, 140, 190, 95],
            }, ],
          },
          options: {
            layout: {
              padding: {
                left: 20,
                right: 20,
                top: 0,
                bottom: 0,
              },
            },
            maintainAspectRatio: false,
            tooltips: {
              backgroundColor: "#fff",
              titleFontColor: "#333",
              bodyFontColor: "#666",
              bodySpacing: 4,
              xPadding: 12,
              mode: "nearest",
              intersect: 0,
              position: "nearest",
            },
            legend: {
              position: "bottom",
              fillStyle: "#FFF",
              display: false,
            },
            scales: {
              yAxes: [{
                ticks: {
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold",
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  padding: 10,
                },
                gridLines: {
                  drawTicks: true,
                  drawBorder: false,
                  display: true,
                  color: "rgba(255,255,255,0.1)",
                  zeroLineColor: "transparent",
                },
              }, ],
              xAxes: [{
                gridLines: {
                  zeroLineColor: "transparent",
                  display: false,
                },
                ticks: {
                  padding: 10,
                  fontColor: "rgba(255,255,255,0.4)",
                  fontStyle: "bold",
                },
              }, ],
            },
          },
        });



        fetch("<?= getBaseUrl() ?>/controllers/task.php?op=count", {
            method: 'GET',
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            ctx = document
              .getElementById("lineChartExampleCasos")
              .getContext("2d");
            gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, "#18ce0f");
            gradientStroke.addColorStop(1, chartColor);

            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, hexToRGB("#18ce0f", 0.4));

            myChart = new Chart(ctx, {
              type: "line",
              responsive: true,
              data: {
                labels: [
                  "JAN",
                  "FEB",
                  "MAR",
                  "APR",
                  "MAY",
                  "JUN",
                  "JUL",
                  "AUG",
                  "SEP",
                  "OCT",
                  "NOV",
                  "DEC",
                ],
                datasets: [{
                  label: "Email Stats",
                  borderColor: "#18ce0f",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#18ce0f",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  backgroundColor: gradientFill,
                  borderWidth: 2,
                  data: data,
                }, ],
              },
              options: gradientChartOptionsConfigurationWithNumbersAndGrid,
            });

          });




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
            const dataUsers = [];
            data.forEach(element => {
              dataUsers.push(parseInt(element.value));
            });
            ctx = document
              .getElementById("lineChartExampleWithNumbersAndGrid")
              .getContext("2d");
            gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, "#18ce0f");
            gradientStroke.addColorStop(1, chartColor);

            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, hexToRGB("#18ce0f", 0.4));

            myChart = new Chart(ctx, {
              type: "line",
              responsive: true,
              data: {
                labels: [
                  "JAN",
                  "FEB",
                  "MAR",
                  "APR",
                  "MAY",
                  "JUN",
                  "JUL",
                  "AUG",
                  "SEP",
                  "OCT",
                  "NOV",
                  "DEC",
                ],
                datasets: [{
                  label: "Email Stats",
                  borderColor: "#18ce0f",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#18ce0f",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  backgroundColor: gradientFill,
                  borderWidth: 2,
                  data: dataUsers,
                }, ],
              },
              options: gradientChartOptionsConfigurationWithNumbersAndGrid,
            });

          });

        fetch("<?= getBaseUrl() ?>/controllers/adjunto.php?op=count", {
            method: 'GET',
          })
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            var e = document
              .getElementById("barChartSimpleGradientsNumbers")
              .getContext("2d");

            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, hexToRGB("#2CA8FF", 0.6));
            var a = {
              type: "bar",
              data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Ocutubre", "Noviembre", "Diciembre"],
                datasets: [{
                  label: "Documentos activos",
                  backgroundColor: gradientFill,
                  borderColor: "#2CA8FF",
                  pointBorderColor: "#FFF",
                  pointBackgroundColor: "#2CA8FF",
                  pointBorderWidth: 2,
                  pointHoverRadius: 4,
                  pointHoverBorderWidth: 1,
                  pointRadius: 4,
                  fill: true,
                  borderWidth: 1,
                  data: data
                }]
              },
              options: {
                maintainAspectRatio: false,
                legend: {
                  display: false
                },
                tooltips: {
                  bodySpacing: 4,
                  mode: "nearest",
                  intersect: 0,
                  position: "nearest",
                  xPadding: 10,
                  yPadding: 10,
                  caretPadding: 10
                },
                responsive: 1,
                scales: {
                  yAxes: [{
                    gridLines: 0,
                    gridLines: {
                      zeroLineColor: "transparent",
                      drawBorder: false
                    }
                  }],
                  xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                      display: false
                    },
                    gridLines: {
                      zeroLineColor: "transparent",
                      drawTicks: false,
                      display: false,
                      drawBorder: false
                    }
                  }]
                },
                layout: {
                  padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                  }
                }
              }
            };

            var viewsChart = new Chart(e, a);

          });


      },

      initGoogleMaps: function() {
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
          zoom: 13,
          center: myLatlng,
          scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
          styles: [{
              featureType: "water",
              elementType: "geometry",
              stylers: [{
                  color: "#e9e9e9",
                },
                {
                  lightness: 17,
                },
              ],
            },
            {
              featureType: "landscape",
              elementType: "geometry",
              stylers: [{
                  color: "#f5f5f5",
                },
                {
                  lightness: 20,
                },
              ],
            },
            {
              featureType: "road.highway",
              elementType: "geometry.fill",
              stylers: [{
                  color: "#ffffff",
                },
                {
                  lightness: 17,
                },
              ],
            },
            {
              featureType: "road.highway",
              elementType: "geometry.stroke",
              stylers: [{
                  color: "#ffffff",
                },
                {
                  lightness: 29,
                },
                {
                  weight: 0.2,
                },
              ],
            },
            {
              featureType: "road.arterial",
              elementType: "geometry",
              stylers: [{
                  color: "#ffffff",
                },
                {
                  lightness: 18,
                },
              ],
            },
            {
              featureType: "road.local",
              elementType: "geometry",
              stylers: [{
                  color: "#ffffff",
                },
                {
                  lightness: 16,
                },
              ],
            },
            {
              featureType: "poi",
              elementType: "geometry",
              stylers: [{
                  color: "#f5f5f5",
                },
                {
                  lightness: 21,
                },
              ],
            },
            {
              featureType: "poi.park",
              elementType: "geometry",
              stylers: [{
                  color: "#dedede",
                },
                {
                  lightness: 21,
                },
              ],
            },
            {
              elementType: "labels.text.stroke",
              stylers: [{
                  visibility: "on",
                },
                {
                  color: "#ffffff",
                },
                {
                  lightness: 16,
                },
              ],
            },
            {
              elementType: "labels.text.fill",
              stylers: [{
                  saturation: 36,
                },
                {
                  color: "#333333",
                },
                {
                  lightness: 40,
                },
              ],
            },
            {
              elementType: "labels.icon",
              stylers: [{
                visibility: "off",
              }, ],
            },
            {
              featureType: "transit",
              elementType: "geometry",
              stylers: [{
                  color: "#f2f2f2",
                },
                {
                  lightness: 19,
                },
              ],
            },
            {
              featureType: "administrative",
              elementType: "geometry.fill",
              stylers: [{
                  color: "#fefefe",
                },
                {
                  lightness: 20,
                },
              ],
            },
            {
              featureType: "administrative",
              elementType: "geometry.stroke",
              stylers: [{
                  color: "#fefefe",
                },
                {
                  lightness: 17,
                },
                {
                  weight: 1.2,
                },
              ],
            },
          ],
        };

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
          position: myLatlng,
          title: "Hello World!",
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
      },
    };


    demo.initDashboardPageCharts();
  });
</script>
</body>

</html>