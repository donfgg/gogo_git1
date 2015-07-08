<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <title id='Description'>jqxChart Stacked Line Series Example</title>
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxchart.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare the data
            var source =
            {
                datatype: "tab",
                datafields: [
                    { name: 'Date' },
                    { name: 'Referral' },
                    { name: 'SearchPaid' },
                    
                ],
                url: 'website_analytics.txt'
            };

            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            // prepare jqxChart settings
            var settings = {
                title: "Daily Sale(Jan 2015)",
                description: "",
                enableAnimations: true,
                showLegend: true,
                padding: { left: 5, top: 5, right: 11, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                categoryAxis:
                    {
                        text: 'Category Axis',
                        textRotationAngle: 0,
                        dataField: 'Date',
                        formatFunction: function (value) {
                            return  value.getDate();
                        },
                        toolTipFormatFunction: function (value) {
                            return value.getDate() + '-' + months[value.getMonth()] + '-' + value.getFullYear();
                        },
                        showTickMarks: true,
                        type: 'date',
                        baseUnit: 'day',
                        tickMarksInterval: 1,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        showGridLines: true,
                        gridLinesInterval: 31,
                        gridLinesColor: '#888888',
                        minValue: '01/01/2015',
                        maxValue: '01/31/2015',
                        valuesOnTicks: false
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'stackedline',
                            valueAxis:
                            {
                                unitInterval: 500,
                                minValue: 0,
                                maxValue: 3000,
                                displayValueAxis: true,
                                description: 'Daily Visits',
                                //descriptionClass: 'css-class-name',
                                axisSize: 'auto',
                                tickMarksColor: '#888888'
                            },
                            series: [
                                    { dataField: 'Referral', displayText: 'This Year' },
                                    { dataField: 'SearchPaid', displayText: 'Last Year' },
                                    
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#jqxChart').jqxChart(settings);

        });
    </script>
</head>
<body class='default'>
    <div id='jqxChart' style="width:1080px; height:500px">
    </div>
</body>
</html>