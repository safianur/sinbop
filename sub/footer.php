</div>
</div>
</div>
<!-- END: Content-->

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow d-print-none">
	<div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
		<span class="float-md-left d-block d-md-inline-block">2023 &copy; Copyright | Repost by Saff</span>
		<ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
		</ul>
	</div>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="./assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="./assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="./assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!--<script src="-->
<?//= base_url()?>
<!--assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>-->
<!--<script src="-->
<?//= base_url()?>
<!--assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>-->
<script src="./assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
<script src="./assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
<script src="./assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
<script src="./assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
<script src="./assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
<script src="./assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script>

<script src="./assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="./assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="./assets/js/core/app.min.js" type="text/javascript"></script>
<script src="./assets/js/scripts/customizer.min.js" type="text/javascript"></script>
<script src="./assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!--<script src="-->
<?//= base_url()?>
<!--assets/js/scripts/pages/dashboard-analytics.min.js" type="text/javascript"></script>-->
<script src="./assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="./assets/js/scripts/tables/datatables/datatable-basic.min.js" type="text/javascript"></script>

<script src="./assets/js/scripts/forms/select/form-select2.min.js" type="text/javascript"></script>

<script src="./assets/js/scripts/popover/popover.min.js" type="text/javascript"></script>

<script src="./assets/js/scripts/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>

<script src="./assets/js/core/sigaka.js" type="text/javascript"></script>
<!-- END: Page JS-->

<!-- Page Plugins grafik -->
<script src="./assets/js/chart/chart.js"></script>

<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var data = {
        labels: [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ],
        
        datasets: [
        <?php
            $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
            while($tampil_kat = mysqli_fetch_array($kat)){
        ?>
        {
            label:
                <?php
                    echo "'" .$tampil_kat['nm_kategori']. "'," ;
                ?>
                    
            data: [
                <?php
                    $id_kat = $tampil_kat['id_kategori'];
                    $ambil = mysqli_query($koneksi, "SELECT nm_kategori, DATE_FORMAT(tanggal, '%m-%Y') as tanggal, 
                    SUM(jumlah) as jumlah FROM pengeluaran JOIN kategori ON kategori.id_kategori=pengeluaran.id_kategori 
                    WHERE pengeluaran.id_kategori=$id_kat GROUP BY nm_kategori, MONTH(tanggal), YEAR(tanggal) DESC;");
                    while ($data = mysqli_fetch_array($ambil)){
                        echo "'" .$data['jumlah']. "'," ;
                    }
                ?>
            ],
        },
            <?php } ?>
        ]
    }

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            legend: {
                display: false
            },
            barValueSpacing: 20,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }]
            }
        }
    });
</script>

</body>
<!-- END: Body-->

</html>
