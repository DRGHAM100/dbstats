  # DBStats Laravel Package

The **DBStats** package for Laravel provides MySQL table statistics, performance monitoring, and visualization of table data using diagrams. It allows you to gather insights about your database tables and present them with charts for easy analysis.

## Features

- **MySQL Table Statistics**: Retrieve detailed information about MySQL tables, such as the number of rows, data length, index length, and more.
- **Performance Monitoring**: Measure the performance of your queries with execution times.
- **Diagrams**: Visualize table statistics using **Chart.js**.
- **Laravel Integration**: Easily integrate into your Laravel project.

## Requirements

- Laravel 8 or 9
- PHP 8.0 or higher
- MySQL Database

## Installation

To install the **DBStats** package, follow these steps:

### 1. Install the package via Composer

You can install the package in your Laravel project by adding the repository URL to your `composer.json` file.

#### Option 1: Use GitHub repository directly

Add the following to the `repositories` section of your `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/DRGHAM100/drgham-dbstats"
    }
],
```

Then, run:

```bash
composer require drgham/dbstats
```

#### Option 2: Use Packagist

You can simply install it via:

```bash
composer require drgham/dbstats
```

### 2. Register the Service Provider

After installation, you need to register the service provider in your `config/app.php` file:

```php
'providers' => [
    drgham\DBStats\Providers\DBStatsServiceProvider::class,
],
```

### 3. Publish the configuration file (optional)

If you have a configuration file, you can publish it with the following Artisan command:

```bash
php artisan vendor:publish --provider="drgham\DBStats\Providers\DBStatsServiceProvider"
```

This will copy the configuration file to the `config/dbstats.php` location in your Laravel project.

## Usage

### 1. Retrieve MySQL Table Statistics

You can use the `DBStats` service to retrieve statistics for any table in your database. Simply call the `getTableStatistics()` method to get table stats, such as rows, data length, index length, etc.

Example:

```php
use drgham\DBStats\Services\DBStats;

$tableStats = (new DBStats())->getTableStatistics('users');
dd($tableStats);
```

This will return an array of table statistics like:

```php
[
    'name' => 'users',
    'rows' => 5000,
    'data_length' => 102400,
    'index_length' => 51200,
    'data_free' => 25600,
    'create_time' => '2022-01-01 12:00:00',
]
```

### 2. View Table Statistics in a Diagram

You can also display the statistics in a **Chart.js** bar chart in your view.

#### Example Controller:

```php
use drgham\DBStats\Services\DBStats;

public function showStatistics(string $table)
{
    $tableStats = (new DBStats())->getTableStatistics($table);

    return view('dbstats::statistics', compact('tableStats'));
}
```

#### Example View (Blade):

```blade
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
```

This will generate a bar chart showing statistics for the table.

### 3. Monitor Query Performance

You can also monitor query performance using the `getQueryPerformance()` method. For example:

```php
$queryPerformance = (new DBStats())->getQueryPerformance();
dd($queryPerformance);
```

This will show the executed queries and their performance metrics.

## Configuration

You can configure the behavior of the package by editing the `config/dbstats.php` file. For example, you might want to enable or disable performance monitoring:

```php
return [
    'enable_performance_monitoring' => true,
];
```

## License

This package is open-source and available under the MIT License.

## Support

If you encounter any issues, feel free to open an issue on the [GitHub repository](https://github.com/DRGHAM100/drgham-dbstats/issues).
