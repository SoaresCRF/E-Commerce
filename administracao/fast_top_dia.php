<?php 
include ("verificar_acesso/login_dono.php");
include("header.php"); 
?>

<section class="home-section">
    <div class="home-content">
        <i class='bx bx-menu'></i>
    </div>
    <div class="container-fluid" style="width: inherit;">
        <!-- Pode tirar o inherit -->
        <div class="row">
            <div class="col-sm">
                <!-- Conteúdo -->
                <div id="chartdiv"></div>


            </div>
        </div>
    </div>
</section>

<!-- GRÁFICO -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script>
    am5.ready(function() {
        var root = am5.Root.new("chartdiv");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true
        }));

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
        });

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "country",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


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
            cornerRadiusTR: 5
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });


        // Set data
        var data = [
            <?php
            $sql = "SELECT nome_produto, sum(qtd_comprada) from controle_venda
                    where data_venda = CURDATE()
                    group by nome_produto, fornecedor
                    order by qtd_comprada desc";
            $query_controle_venda = mysqli_query($conexao, $sql);
            while ($row_controle_venda = mysqli_fetch_assoc($query_controle_venda)) {
            ?> {
                    country: "<?php echo $row_controle_venda['nome_produto'] ?>",
                    value: <?php echo $row_controle_venda['sum(qtd_comprada)'] ?>
                },

            <?php } ?>
        ];

        xAxis.data.setAll(data);
        series.data.setAll(data);


        series.appear(1000);
        chart.appear(1000, 100);

    });
</script>

<?php include("footer.php"); ?>