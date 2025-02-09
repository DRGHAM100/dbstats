<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistics for Table: {{ $tableStats['name'] }}</h1>

    <canvas id="statsChart"></canvas>

    <script>
        var ctx = document.getElementById('statsChart').getContext('2d');
        var statsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Rows', 'Data Length', 'Index Length', 'Data Free'],
                datasets: [{
                    label: 'Table Stats',
                    data: [
                        {{ $tableStats['rows'] }},
                        {{ $tableStats['data_length'] }},
                        {{ $tableStats['index_length'] }},
                        {{ $tableStats['data_free'] }},
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
