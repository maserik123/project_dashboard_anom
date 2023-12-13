<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->


        <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up">
            </div>
            <div class="col-md-12">
                <small style="font-weight: bold;">Project by Criteria/Type</small>
            </div>
            <?php foreach ($getCriteria as $row) {
                $query = $this->db->query('SELECT COUNT(a.project_m_hdr_id) AS total FROM project_m_hdr a 
                INNER JOIN master_project b ON b.master_project_id = a.master_project_id WHERE b.criteria_project_id ="' . $row->criteria_project_id . '" order by b.criteria_project_id asc')->row_array();
            ?>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box bg-<?php echo $row->color_status; ?>">

                        <div class="info-box-content">
                            <span class="info-box-text">
                                <small> Project <?php echo $row->criteria_project_name; ?></small></span>
                            <span class="info-box-number"><small><?php echo $query['total'] ?> Items</small></span>
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
                                dom: 'Bfrtip',
                                buttons: [
                                    'excel',
                                ],
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
                                            <th rowspan="2">Type Projects</th>
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
                                <small class="badge text-white" style="background-color:blue">Up to date</small>
                                <small class="badge text-white" style="background-color:green">2 - 7 Days</small>
                                <small class="badge text-white" style="background-color:orange">1 - 2 Weeks</small>
                                <small class="badge text-white" style="background-color:red">> 2 Weeks</small>
                                <small class="badge text-white" style="background-color:grey">Not Started</small>
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
                                <?php $q_rev = $this->db->query('SELECT SUM(revenue_realization) AS actual_tot, SUM(revenue_target) AS plan_tot FROM project_m_hdr')->row_array(); ?>
                                <?php $q_cost_capex = $this->db->query('SELECT SUM(capex_realization) AS actual_tot, SUM(capex_budget) AS plan_tot FROM project_m_hdr')->row_array(); ?>
                                <?php $q_mitigation = $this->db->query('SELECT COUNT(*) AS tot_mitigation FROM risk_mitigation')->row_array(); ?>
                                <?php $q_mitigation_complete = $this->db->query('SELECT COUNT(*) AS complete_mitigation FROM risk_mitigation WHERE checklist = 1')->row_array(); ?>
                                <?php $q_problem = $this->db->query('SELECT COUNT(*) AS tot_problem FROM issue_problem')->row_array(); ?>
                                <?php $q_problem_complete = $this->db->query("SELECT COUNT(*) AS complete_problem FROM issue_problem WHERE STATUS = 'completed'")->row_array(); ?>
                                <div class="description-block border-right bg-orange">
                                    <span class="description-percentage text-white"> Actual : <?php echo rupiah_format($q_rev['actual_tot']); ?></span>
                                    <h5 class="description-header">Plan : <?php echo rupiah_format($q_rev['plan_tot']); ?></h5>
                                    <span class="description-text">TOTAL REVENUE (Rp. Juta)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right bg-red">
                                    <span class="description-percentage text-white"> Actual : <?php echo rupiah_format($q_cost_capex['actual_tot']); ?></span>
                                    <h5 class="description-header">Plan : <?php echo rupiah_format($q_cost_capex['plan_tot']); ?></h5>
                                    <span class="description-text">TOTAL COST (Rp. Juta)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right bg-green">
                                    <span class="description-percentage text-white">Mitigasi Selesai : <?php echo $q_mitigation_complete['complete_mitigation']; ?></span>
                                    <h5 class="description-header">Jumlah Mitigasi : <?php echo $q_mitigation['tot_mitigation']; ?></h5>
                                    <span class="description-text">KEPATUHAN MANRIS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block bg-blue">
                                    <!-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> -->
                                    <span class="description-percentage text-white">Isu Selesai : <?php echo $q_problem_complete['complete_problem'] ?></span>
                                    <h5 class="description-header">Jumlah Isu : <?php echo $q_problem['tot_problem']; ?></h5>
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
                            By Status in <?php echo date('Y'); ?>
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
                                    <?php $query = $this->db->query('select * from project_status')->result(); ?>
                                    series.data.setAll([
                                        <?php foreach ($query as $row) { ?>
                                            <?php $q_project = $this->db->query('select count(*) as total from project_m_hdr where project_status_id = "' . $row->project_status_id . '" and year(update_date) = "' . date('Y') . '"')->row_array(); ?> {
                                                value: <?php echo $q_project['total']; ?>,
                                                category: "<?php echo $row->status_name; ?>"
                                            },
                                        <?php } ?>
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
                            By Type/Criteria in <?php echo date('Y'); ?>
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
                                    <?php $q_criteria = $this->db->query('select * from criteria_project')->result(); ?>

                                    series.data.setAll([
                                        <?php foreach ($q_criteria as $row) { ?> {
                                                <?php $q_valByCriteria = $this->db->query(' SELECT COUNT(b.master_project_id) AS total from project_m_hdr a
                                    inner join master_project b on b.master_project_id = a.master_project_id 
                                    where b.criteria_project_id = "' . $row->criteria_project_id . '" and year(update_date) = "' . date('Y') . '"')->row_array(); ?>
                                                category: "<?php echo $row->criteria_project_name; ?>",
                                                    value: <?php echo $q_valByCriteria['total']; ?>
                                            },
                                        <?php } ?>
                                    ]);

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

                            <div id="chartdiv2" style="height: 400px;font-size:10px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end



                var chart = am4core.create('chartdiv5', am4charts.XYChart)
                chart.colors.step = 2;

                chart.legend = new am4charts.Legend()
                chart.legend.position = 'top'
                chart.legend.paddingBottom = 20
                chart.legend.labels.template.maxWidth = 95

                var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                xAxis.dataFields.category = 'category'
                xAxis.renderer.cellStartLocation = 0.1
                xAxis.renderer.cellEndLocation = 0.9
                xAxis.renderer.grid.template.location = 0;

                var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                yAxis.min = 0;

                function createSeries(value, name) {
                    var series = chart.series.push(new am4charts.ColumnSeries())
                    series.dataFields.valueY = value
                    series.dataFields.categoryX = 'category'
                    series.name = name

                    series.events.on("hidden", arrangeColumns);
                    series.events.on("shown", arrangeColumns);

                    var bullet = series.bullets.push(new am4charts.LabelBullet())
                    bullet.interactionsEnabled = false
                    bullet.dy = 30;
                    bullet.label.text = '{valueY}'
                    bullet.label.fill = am4core.color('#ffffff')

                    return series;
                }
                <?php $getBulan = $this->db->query('select month(crt_date) as bulan from project_m_hdr a
                                inner join master_project b ON b.master_project_id = a.master_project_id
                                group by month(a.crt_date), b.criteria_project_id ')->result(); ?>

                chart.data = [
                    <?php foreach ($getBulan as $row) { ?> {
                            <?php $getType = $this->db->query('select b.criteria_project_id, c.criteria_project_name from project_m_hdr a
                                inner join master_project b ON b.master_project_id = a.master_project_id
                                inner join criteria_project c on c.criteria_project_id = b.criteria_project_id 
                                where month(a.crt_date) = ' . $row->bulan . ' group by b.criteria_project_id')->result(); ?>
                            category: '<?php echo getBulan($row->bulan); ?>',
                                <?php foreach ($getType as $c) { ?>
                            <?php $getByCriteriaID = $this->db->query("SELECT COUNT(*) as jlh FROM project_m_hdr a
                                inner join master_project b ON b.master_project_id = a.master_project_id
                                WHERE b.criteria_project_id = " . $c->criteria_project_id)->row_array(); ?>

                            <?php echo $c->criteria_project_id ?>: <?php echo ($getByCriteriaID['jlh'] == '' || empty($getByCriteriaID['jlh'])) ? 0 : $getByCriteriaID['jlh']; ?>,
                            <?php } ?>
                        },

                    <?php } ?>

                ]

                <?php foreach ($getType as $b) { ?>
                    createSeries('<?php echo $b->criteria_project_id ?>', '<?php echo $b->criteria_project_name; ?>');
                <?php } ?>

                function arrangeColumns() {

                    var series = chart.series.getIndex(0);

                    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                    if (series.dataItems.length > 1) {
                        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                        var delta = ((x1 - x0) / chart.series.length) * w;
                        if (am4core.isNumber(delta)) {
                            var middle = chart.series.length / 2;

                            var newIndex = 0;
                            chart.series.each(function(series) {
                                if (!series.isHidden && !series.isHiding) {
                                    series.dummyData = newIndex;
                                    newIndex++;
                                } else {
                                    series.dummyData = chart.series.indexOf(series);
                                }
                            })
                            var visibleCount = newIndex;
                            var newMiddle = visibleCount / 2;

                            chart.series.each(function(series) {
                                var trueIndex = chart.series.indexOf(series);
                                var newIndex = series.dummyData;

                                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                series.animate({
                                    property: "dx",
                                    to: dx
                                }, series.interpolationDuration, series.interpolationEasing);
                                series.bulletsContainer.animate({
                                    property: "dx",
                                    to: dx
                                }, series.interpolationDuration, series.interpolationEasing);
                            })
                        }
                    }
                }

            }); // end am4core.ready()
        </script>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="fas fa-table"></i>
                            Project Cumulative <?php echo date('Y'); ?>
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


                            <div id="chartdiv5" style="height: 400px;font-size:10px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>


    </div><!--/. container-fluid -->
</section>

<script>
    function detail_dashboard(project_id) {
        window.open('<?php echo base_url("administrator/dashboard_detail/"); ?>' + project_id, '_blank');
    }
</script>