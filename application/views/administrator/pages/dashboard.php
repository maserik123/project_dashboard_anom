<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?php echo $projectActiveMore30Day['total']; ?></h3>

                        <p>Active More 30 than Days</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Project Totals
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $projectActiveMin30Day['total']; ?></h3>

                        <p>Active Less than 30 Days</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Project Totals
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $projectActive2Week['total']; ?></h3>

                        <p>End in 2 Weeks</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Project Totals
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $projectActive1Week['total']; ?></h3>

                        <p>End in 1 Week</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Project Totals
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-green">

                    <div class="info-box-content">
                        <span class="info-box-text"><small><strong>Projects Total </strong>
                                <br>(Finished 100%)</small></span>
                        <span class="info-box-number">
                            <?php echo $projectFinish100['total'] ?>
                            <small>Items</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-green">

                    <div class="info-box-content">
                        <span class="info-box-text"><small><strong>Projects Total</strong> <br> (Progress > 50%)</small></span>
                        <span class="info-box-number">
                            <?php echo $projectProgressMore50['total']; ?>
                            <small>Items</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-green">

                    <div class="info-box-content">
                        <span class="info-box-text"> <small><strong>Projects Total</strong> <br> (Progress < 50%)</small></span>
                        <span class="info-box-number">
                            <?php echo $projectProgressMin50['total']; ?>
                            <small>Items</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <?php foreach ($getCriteria as $row) {
                $query = $this->db->query('SELECT COUNT(a.project_m_hdr_id) AS total FROM project_m_hdr a 
                INNER JOIN master_project b ON b.master_project_id = a.master_project_id WHERE b.criteria_project_id ="' . $row->criteria_project_id . '" order by b.criteria_project_id asc')->row_array();
            ?>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box bg-red">

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <small> Progress <?php echo $row->criteria_project_name; ?></small></span>
                            <span class="info-box-number"><small><?php echo $query['total'] ?></small></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            <?php } ?>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            List Projects
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <script>
                        $(document).ready(function() {
                            table = $('#projectHeader').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "lengthMenu": [
                                    [10, 25, 50, -1],
                                    [10, 25, 50, "All"]
                                ],
                                "responsive": true,
                                "dataType": 'JSON',
                                "ajax": {
                                    "url": "<?php echo site_url('administrator/projectHeader/getDataDashboard') ?>",
                                    "type": "POST",
                                    "data": {
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                    }
                                },
                                "order": [
                                    [0, "desc"]
                                ],
                                "columnDefs": [{
                                    "targets": [0],
                                    "className": "center"
                                }]
                            });
                        });
                    </script>
                    <div class="card-body">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="projectHeader" class="table table-bordered table-responsive table-striped">
                                    <thead style="font-size: 13px;">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Projects Details</th>
                                            <th rowspan="2">Projects Name</th>
                                            <th rowspan="2">PIC</th>
                                            <th rowspan="2">Criteria/Type Projects</th>
                                            <th colspan="2">Waktu</th>
                                            <th rowspan="2">Capex Budget</th>
                                            <th rowspan="2">Contract Value</th>
                                            <th rowspan="2">Status</th>
                                            <th rowspan="2">Progress</th>
                                            <th rowspan="2">Update</th>
                                        </tr>
                                        <tr>
                                            <th>Start</th>
                                            <th>End</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 13px;"></tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.chart-responsive -->
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"> Actual : Rp 50.000</span>
                                    <h5 class="description-header">Plan : Rp 200.000</h5>
                                    <span class="description-text">TOTAL REVENUE (Rp. Juta)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"> Actual : Rp 50.000</span>
                                    <h5 class="description-header">Plan : Rp 200.000</h5>
                                    <span class="description-text">TOTAL COST (Rp. Juta)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-primary">Mitigasi Selesai : 60</span>
                                    <h5 class="description-header">Jumlah Mitigasi : 100</h5>
                                    <span class="description-text">KEPATUHAN MANRIS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <!-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> -->
                                    <span class="description-percentage text-danger">Isu Selesai : 60</span>
                                    <h5 class="description-header">Jumlah Isu : 100</h5>
                                    <span class="description-text">ISU PERMASALAHAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            By Status in 2023
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Chart code -->
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv");


                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);


                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                    var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                        layout: root.verticalLayout
                                    }));


                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                    var series = chart.series.push(am5percent.PieSeries.new(root, {
                                        valueField: "value",
                                        categoryField: "category"
                                    }));


                                    // Set data
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                    series.data.setAll([{
                                            value: 10,
                                            category: "Belum Mulai"
                                        },
                                        {
                                            value: 9,
                                            category: "Persiapan"
                                        },
                                        {
                                            value: 6,
                                            category: "Perencanaan"
                                        },
                                        {
                                            value: 5,
                                            category: "Kajian"
                                        },
                                        {
                                            value: 4,
                                            category: "Pengadaan"
                                        },
                                        {
                                            value: 3,
                                            category: "Koordinasi"
                                        },
                                        {
                                            value: 1,
                                            category: "Fisik"
                                        },
                                        {
                                            value: 1,
                                            category: "Lelang Mitra"
                                        },
                                        {
                                            value: 1,
                                            category: "Perawatan"
                                        },
                                        {
                                            value: 1,
                                            category: "Selesai"
                                        },
                                        {
                                            value: 1,
                                            category: "Pending"
                                        },
                                        {
                                            value: 1,
                                            category: "Cancel"
                                        },
                                    ]);


                                    // Create legend
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                    var legend = chart.children.push(am5.Legend.new(root, {
                                        centerX: am5.percent(50),
                                        x: am5.percent(50),
                                        marginTop: 15,
                                        marginBottom: 15
                                    }));

                                    legend.data.setAll(series.dataItems);


                                    // Play initial series animation
                                    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                    series.appear(1000, 100);

                                }); // end am5.ready()
                            </script>

                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv123");

                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);

                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                    var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                        radius: am5.percent(90),
                                        innerRadius: am5.percent(50),
                                        layout: root.horizontalLayout
                                    }));

                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                    var series = chart.series.push(am5percent.PieSeries.new(root, {
                                        name: "Series",
                                        valueField: "sales",
                                        categoryField: "country"
                                    }));

                                    // Set data
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                    series.data.setAll([{
                                        country: "Belum Mulai",
                                        sales: 501.9
                                    }, {
                                        country: "Persiapan",
                                        sales: 301.9
                                    }, {
                                        country: "Perencanaan",
                                        sales: 201.1
                                    }, {
                                        country: "Kajian",
                                        sales: 165.8
                                    }, {
                                        country: "Pengadaan",
                                        sales: 139.9
                                    }, {
                                        country: "Kordinasi",
                                        sales: 128.3
                                    }, {
                                        country: "Fisik",
                                        sales: 99
                                    }, {
                                        country: "Lelang Mitra",
                                        sales: 60
                                    }, {
                                        country: "Perawatan",
                                        sales: 50
                                    }, {
                                        country: "Selesai",
                                        sales: 50
                                    }, {
                                        country: "Pending",
                                        sales: 50
                                    }, {
                                        country: "Cancel",
                                        sales: 50
                                    }]);

                                    // Disabling labels and ticks
                                    series.labels.template.set("visible", false);

                                    series.ticks.template.set("visible", false);

                                    // Adding gradients
                                    series.slices.template.set("strokeOpacity", 0);
                                    series.slices.template.set("fillGradient", am5.RadialGradient.new(root, {
                                        stops: [{
                                            brighten: -0.8
                                        }, {
                                            brighten: -0.8
                                        }, {
                                            brighten: -0.5
                                        }, {
                                            brighten: 0
                                        }, {
                                            brighten: -0.5
                                        }]
                                    }));

                                    // Create legend
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                    var legend = chart.children.push(am5.Legend.new(root, {
                                        centerY: am5.percent(50),
                                        y: am5.percent(50),
                                        layout: root.verticalLayout
                                    }));
                                    // set value labels align to right
                                    legend.valueLabels.template.setAll({
                                        textAlign: "right"
                                    })
                                    // set width and max width of labels
                                    legend.labels.template.setAll({
                                        maxWidth: 140,
                                        width: 140,
                                        oversizedBehavior: "wrap"
                                    });

                                    legend.data.setAll(series.dataItems);


                                    // Play initial series animation
                                    // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                    series.appear(1000, 100);

                                }); // end am5.ready()
                            </script>
                            <div id="chartdiv" style="height: 400px;font-size:11px;font-color:white;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            By Type/Criteria in 2023
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Chart code -->
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv2");

                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);


                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                    var chart = root.container.children.push(
                                        am5percent.PieChart.new(root, {
                                            endAngle: 270,
                                            layout: root.verticalLayout,
                                            innerRadius: am5.percent(60)
                                        })
                                    );
                                    /*
                                    var bg = root.container.set("background", am5.Rectangle.new(root, {
                                      fillPattern: am5.GrainPattern.new(root, {
                                        density: 0.1,
                                        maxOpacity: 0.2
                                      })
                                    }))

                                    */

                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                    var series = chart.series.push(
                                        am5percent.PieSeries.new(root, {
                                            valueField: "value",
                                            categoryField: "category",
                                            endAngle: 270
                                        })
                                    );

                                    series.set("colors", am5.ColorSet.new(root, {
                                        colors: [
                                            am5.color(0x73556E),
                                            am5.color(0x9FA1A6),
                                            am5.color(0xF2AA6B),
                                            am5.color(0xF28F6B),
                                            am5.color(0xA95A52),
                                            am5.color(0xE35B5D),
                                            am5.color(0xFFA446)
                                        ]
                                    }))

                                    var gradient = am5.RadialGradient.new(root, {
                                        stops: [{
                                                color: am5.color(0x000000)
                                            },
                                            {
                                                color: am5.color(0x000000)
                                            },
                                            {}
                                        ]
                                    })

                                    series.slices.template.setAll({
                                        fillGradient: gradient,
                                        strokeWidth: 2,
                                        stroke: am5.color(0xffffff),
                                        cornerRadius: 10,
                                        shadowOpacity: 0.1,
                                        shadowOffsetX: 2,
                                        shadowOffsetY: 2,
                                        shadowColor: am5.color(0x000000),
                                        fillPattern: am5.GrainPattern.new(root, {
                                            maxOpacity: 0.2,
                                            density: 0.5,
                                            colors: [am5.color(0x000000)]
                                        })
                                    })

                                    series.slices.template.states.create("hover", {
                                        shadowOpacity: 1,
                                        shadowBlur: 10
                                    })

                                    series.ticks.template.setAll({
                                        strokeOpacity: 0.4,
                                        strokeDasharray: [2, 2]
                                    })

                                    series.states.create("hidden", {
                                        endAngle: -90
                                    });

                                    // Set data
                                    // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                    series.data.setAll([{
                                        category: "Lithuania",
                                        value: 500
                                    }, {
                                        category: "Czechia",
                                        value: 300
                                    }, {
                                        category: "Ireland",
                                        value: 200
                                    }, {
                                        category: "Germany",
                                        value: 100
                                    }]);

                                    var legend = chart.children.push(am5.Legend.new(root, {
                                        centerX: am5.percent(50),
                                        x: am5.percent(50),
                                        marginTop: 15,
                                        marginBottom: 15,
                                    }));
                                    legend.markerRectangles.template.adapters.add("fillGradient", function() {
                                        return undefined;
                                    })
                                    legend.data.setAll(series.dataItems);

                                    series.appear(1000, 100);

                                }); // end am5.ready()
                            </script>

                            <div id="chartdiv2" style="height: 400px;font-size:11px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            Project Contract Value By Criteria in 2023
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv3");

                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);

                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        pinchZoomX: true,
                                        paddingLeft: 0,
                                        paddingRight: 1
                                    }));

                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);


                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, {
                                        minGridDistance: 30,
                                        minorGridEnabled: true
                                    });

                                    xRenderer.labels.template.setAll({
                                        rotation: -90,
                                        centerY: am5.p50,
                                        centerX: am5.p100,
                                        paddingRight: 15
                                    });

                                    xRenderer.grid.template.setAll({
                                        location: 1
                                    })

                                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    }));

                                    var yRenderer = am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                    })

                                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: yRenderer
                                    }));

                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country",
                                        tooltip: am5.Tooltip.new(root, {
                                            labelText: "{valueY}"
                                        })
                                    }));

                                    series.columns.template.setAll({
                                        cornerRadiusTL: 5,
                                        cornerRadiusTR: 5,
                                        strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", function(fill, target) {
                                        return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });

                                    series.columns.template.adapters.add("stroke", function(stroke, target) {
                                        return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });


                                    // Set data
                                    var data = [{
                                        country: "Kerjasama",
                                        value: 50
                                    }, {
                                        country: "Fisik",
                                        value: 3
                                    }, {
                                        country: "Kajian",
                                        value: 4
                                    }];

                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);


                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);

                                }); // end am5.ready()
                            </script>
                            <div id="chartdiv3" style="height: 400px;font-size:11px;color:white;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            Project Contract Value By Status in 2023
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Chart code -->
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv4");

                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);

                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        pinchZoomX: true,
                                        paddingLeft: 0,
                                        paddingRight: 1
                                    }));

                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);


                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, {
                                        minGridDistance: 30,
                                        minorGridEnabled: true
                                    });

                                    xRenderer.labels.template.setAll({
                                        rotation: -45,
                                        centerY: am5.p50,
                                        centerX: am5.p100,
                                        paddingRight: 15
                                    });

                                    xRenderer.grid.template.setAll({
                                        location: 1
                                    })

                                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    }));

                                    var yRenderer = am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                    })

                                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: yRenderer
                                    }));

                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country",
                                        tooltip: am5.Tooltip.new(root, {
                                            labelText: "{valueY}"
                                        })
                                    }));

                                    series.columns.template.setAll({
                                        cornerRadiusTL: 5,
                                        cornerRadiusTR: 5,
                                        strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", function(fill, target) {
                                        return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });

                                    series.columns.template.adapters.add("stroke", function(stroke, target) {
                                        return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });


                                    // Set data
                                    var data = [{
                                            country: "Belum Mulai",
                                            value: 50
                                        }, {
                                            country: "Persiapan",
                                            value: 3
                                        }, {
                                            country: "Perencanaan",
                                            value: 4
                                        },
                                        {
                                            country: "Kajian",
                                            value: 4
                                        },
                                        {
                                            country: "Pengadaan",
                                            value: 4
                                        },
                                        {
                                            country: "Kordinasi",
                                            value: 4
                                        }, {
                                            country: "Fisik",
                                            value: 4
                                        }, {
                                            country: "Lelang Mitra",
                                            value: 4
                                        }, {
                                            country: "Perawatan",
                                            value: 4
                                        }, {
                                            country: "Selesai",
                                            value: 4
                                        }, {
                                            country: "Pending",
                                            value: 4
                                        }, {
                                            country: "Cancel",
                                            value: 4
                                        }
                                    ];

                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);


                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);

                                }); // end am5.ready()
                            </script>
                            <div id="chartdiv4" style="height: 400px;font-size:11px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div><!--/. container-fluid -->
</section>

<script>
    function detail_dashboard(project_id) {
        window.open('<?php echo base_url("administrator/dashboard_detail/"); ?>' + project_id, '_blank');
    }
</script>