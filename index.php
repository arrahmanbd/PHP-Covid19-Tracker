<?php
require "includes/config.php";
require "includes/module.php";
include "languages/".$language.".php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="NodeTent">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/app.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" type="text/css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': '<?=$mapAPI?>'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);
        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable([
                ['Country', '<?=$lang['confirmed_cases']?>', ], <?php foreach($result as $map){
                    echo '["'.$map['country'].
                    '",'.$map['cases'].
                    '],';
                } ?>
            ]);
            var options = {
                colorAxis: {
                    colors: ['#D2E3FC', '#8AB4F8', '#4285F4', '#1967D2', '#174EA6', ]
                },
                backgroundColor: '#2A323C',
                legend: {
                    textStyle: {
                        color: '#000',
                        fontSize: 14
                    }
                }
            };
            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body class="dark">
<!-- begin::header -->
<div class="header">
    <div class="header-left">
        <div class="header-logo">
            <a href="/">
                <img class="logo-light" src="assets/images/logo.png" alt="logo">
            </a>
        </div>
    </div>
</div>
<!-- end::header -->
<!-- begin::main -->
<div id="main">
    <!-- begin::main-content -->
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <div class="card bg-dark-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-dark rounded-circle">
                                        <i class="fa fa-ambulance"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($report);?></h2>
                                <h5 class="mb-0"><?=$lang['total_cases']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-danger-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-danger rounded-circle">
                                        <i class="fa fa-hotel"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($death);?></h2>
                                <h5 class="mb-0"><?=$lang['total_deaths']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-primary-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-primary rounded-circle">
                                        <i class="fa fa-heartbeat"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($recover);?></h2>
                                <h5 class="mb-0"><?=$lang['total_recovered']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-secondary rounded-circle">
                                        <i class="fa fa-plus-circle"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($todayCases);?></h2>
                                <h5 class="mb-0"><?=$lang['new_cases_today']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-info-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-info rounded-circle">
                                        <i class="fa fa-minus"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($todayDeaths);?></h2>
                                <h5 class="mb-0"><?=$lang['new_deaths_today']?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-warning-gradient border-0">
                            <div class="card-body text-center">
                                <figure class="avatar mb-3 border-0">
                                    <span class="avatar-title bg-white text-warning rounded-circle">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                </figure>
                                <h2 class="font-weight-bold mb-3"><?php echo number_format($critical);?></h2>
                                <h5 class="mb-0"><?=$lang['critical_cases']?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php echo $ads;?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="regions_div"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?=$lang['location']?></th>
                                                <th><?=$lang['confirmed_cases']?></th>
                                                <th><?=$lang['active_cases']?></th>
                                                <th><?=$lang['critical_cases']?></th>
                                                <th><?=$lang['deaths']?></th>
                                                <th><?=$lang['recovered']?></th>
                                                <th><?=$lang['new_cases_today']?></th>
                                                <th><?=$lang['new_deaths_today']?></th>
                                                <th><?=$lang['mortality_rate']." (%)"?></th>
                                                <th><?=$lang['recovery_rate']." (%)"?></th>
                                                <th><?=$lang['total_tests']?></th>
                                            </tr>
                                        </thead>
                                        <tbody><?php foreach($result as $row){if($row['country'] == "World"){continue;}?>
                                            <tr>
                                                <td><img src="https://www.gstatic.com/onebox/sports/logos/flags/<?php echo strtolower(str_replace(" ","_",$row['image'])); ?>_icon_square.svg" height="20" width="20"> <?php echo $row['country'];?></td>
                                                <td><?php echo number_format($row['cases']);?></td>
                                                <td><?php echo number_format($row['active']);?></td>
                                                <td><?php echo number_format($row['critical']);?></td>
                                                <td><?php echo number_format($row['deaths']);?></td>
                                                <td><?php echo number_format($row['recovered']);?></td>
                                                <td><?php echo number_format($row['todayCases']);?></td>
                                                <td><?php echo number_format($row['todayDeaths']);?></td>
                                                <td><?php echo number_format(($row['deaths']/$row['cases'])*100)."%";?></td>
                                                <td><?php echo number_format(($row['recovered']/$row['cases'])*100)."%";?></td>
                                                <td><?php echo number_format($row['totalTests']);?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin::footer -->
        <footer>
            <div class="container-fluid">
                <div>© <?=date("Y")?> - <a href="https://nodetent.com/" target="_blank" rel="dofollow">NodeTent</a></div>
                <nav class="nav"><a href="https://codecanyon.net/licenses/standard" class="nav-link">Licenses</a></nav>
            </div>
        </footer>
    <!-- end::footer -->
    </div>
    <!-- end::main-content -->
</div>
<!-- end::main -->
<!-- scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/dataTables.responsive.min.js"></script>
<script src="assets/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable({
            order: [],
            paging: true,
            "pageLength": 25,
            "pagingType": "simple",
            "dom": '<"top"flp>rt<"bottom"ip><"clear">',
        });
        console.clear();
    });
</script>
</body>
</html>