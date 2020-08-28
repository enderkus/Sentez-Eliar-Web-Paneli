<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span><?= $footertext; ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Çıkış yapmak istediğinize emin misiniz ?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
  </div>
  <div class="modal-body"><b>Çıkış Yap</b> butonuna basarsanız geçerli oturumunuz sonlandırılacaktır.</div>
  <div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
    <a class="btn btn-primary" href="cikis.php">Çıkış Yap</a>
  </div>
</div>
</div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Turkish.json" charset="utf-8"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->

          <script type="text/javascript">
          // Set new default font family and font color to mimic Bootstrap's default styling
          Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
          Chart.defaults.global.defaultFontColor = '#858796';

          function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
          }

          // Area Chart Example
          var ctx = document.getElementById("myAreaChart");
          var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {


              labels: [<?php

              $orgusorguayyil = $database->query("SELECT year(InsertedAt) as Yil ,MONTH(InsertedAt)as Ay,SUM(NetQuantity) as Uretim From Erp_InventorySerialCard where InsertedAt between dateadd(yyyy,-1,DATEADD(yy, DATEDIFF(yy,0,getdate()), 0)) and GETDATE() and InsertedBy between 21 and 22 GROUP BY year(InsertedAt), MONTH(InsertedAt) order by year(InsertedAt), MONTH(InsertedAt)")->fetchAll();
              foreach ($orgusorguayyil as $osay) {
                echo $labelller = '"'.$osay["Ay"].'-'.$osay["Yil"].'",';
              }
               ?>],
              datasets: [{
                label: "ÜRETİM",
                lineTension: 0.2,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php

                $orgusorguayyil = $database->query("SELECT year(InsertedAt) as Yil ,MONTH(InsertedAt)as Ay,SUM(NetQuantity) as Uretim From Erp_InventorySerialCard where InsertedAt between dateadd(yyyy,-1,DATEADD(yy, DATEDIFF(yy,0,getdate()), 0)) and GETDATE() and InsertedBy between 21 and 22 GROUP BY year(InsertedAt), MONTH(InsertedAt) order by year(InsertedAt), MONTH(InsertedAt)")->fetchAll();
                foreach ($orgusorguayyil as $osay) {
                  echo $labelller = '"'.$osay["Uretim"].'",';
                }
                 ?>],
              }],
            },
            options: {
              maintainAspectRatio: false,
              layout: {
                padding: {
                  left: 10,
                  right: 25,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  time: {
                    unit: 'date'
                  },
                  gridLines: {
                    display: true,
                    drawBorder: true
                  },
                  ticks: {
                    maxTicksLimit: 24
                  }
                }],
                yAxes: [{
                  ticks: {
                    maxTicksLimit: 12,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                      return  number_format(value) + 'KG';
                    }
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: true,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              legend: {
                display: false
              },
              tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                  label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ':' + number_format(tooltipItem.yLabel) + 'KG';
                  }
                }
              }
            }
          });

          </script>

          <script type="text/javascript">
          // Set new default font family and font color to mimic Bootstrap's default styling
          Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
          Chart.defaults.global.defaultFontColor = '#858796';

          function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
              s = '',
              toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
              };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
              s[1] = s[1] || '';
              s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
          }

          // Area Chart Example
          var ctx = document.getElementById("boyahanechart");
          var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {


              labels: [<?php

              $boyahaneayyil = $database->query("SELECT year(ProductionDate) as Yil ,MONTH(ProductionDate)as Ay,SUM(StartQuantity) as Uretim From Erp_WorkOrderProduction where ProductionDate between dateadd(yyyy,-1,DATEADD(yy, DATEDIFF(yy,0,getdate()), 0)) and GETDATE() and ResourceId between 172 and 199 and InOut=2 GROUP BY year(ProductionDate), MONTH(ProductionDate) order by year(ProductionDate), MONTH(ProductionDate)")->fetchAll();
              foreach ($boyahaneayyil as $osay) {
                echo $labelller = '"'.$osay["Ay"].'-'.$osay["Yil"].'",';
              }
               ?>],
              datasets: [{
                label: "ÜRETİM",
                lineTension: 0.2,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php

                $boyahaneuretimi = $database->query("SELECT year(ProductionDate) as Yil ,MONTH(ProductionDate)as Ay,SUM(StartQuantity) as Uretim From Erp_WorkOrderProduction where ProductionDate between dateadd(yyyy,-1,DATEADD(yy, DATEDIFF(yy,0,getdate()), 0)) and GETDATE() and ResourceId between 172 and 199 and InOut=2 GROUP BY year(ProductionDate), MONTH(ProductionDate) order by year(ProductionDate), MONTH(ProductionDate)")->fetchAll();
                foreach ($boyahaneuretimi as $osay) {
                  echo $labelller = '"'.$osay["Uretim"].'",';
                }
                 ?>],
              }],
            },
            options: {
              maintainAspectRatio: false,
              layout: {
                padding: {
                  left: 10,
                  right: 25,
                  top: 25,
                  bottom: 0
                }
              },
              scales: {
                xAxes: [{
                  time: {
                    unit: 'date'
                  },
                  gridLines: {
                    display: true,
                    drawBorder: true
                  },
                  ticks: {
                    maxTicksLimit: 24
                  }
                }],
                yAxes: [{
                  ticks: {
                    maxTicksLimit: 12,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                      return  number_format(value) + 'KG';
                    }
                  },
                  gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: true,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                  }
                }],
              },
              legend: {
                display: false
              },
              tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                  label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ':' + number_format(tooltipItem.yLabel) + 'KG';
                  }
                }
              }
            }
          });

          </script>

</body>

</html>
