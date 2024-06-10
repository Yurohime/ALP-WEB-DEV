@extends('layouts.adminapp')

@section('content')
<div class="container mt-5">

    
    
    <div class="row mb-4">

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Product Sales</h3>
                    <canvas id="productSalesChart"></canvas>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title">Transaction History</h3>
                    <canvas id="transactionHistoryChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title">Transaction Breakdown</h3>
                    <canvas id="transactionBreakdownChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title">Revenue Distribution</h3>
                    <canvas id="revenueDistributionChart"></canvas>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transactionHistoryCtx = document.getElementById('transactionHistoryChart').getContext('2d');
        const transactionBreakdownCtx = document.getElementById('transactionBreakdownChart').getContext('2d');
        const revenueDistributionCtx = document.getElementById('revenueDistributionChart').getContext('2d');
        const productSalesCtx = document.getElementById('productSalesChart').getContext('2d');

        const transactionHistoryChart = new Chart(transactionHistoryCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($transactionHistoryLabels) !!},
                datasets: [{
                    label: 'Transactions Over Time',
                    data: {!! json_encode($transactionHistoryData) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });

        const transactionBreakdownChart = new Chart(transactionBreakdownCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($transactionBreakdownLabels) !!},
                datasets: [{
                    label: 'Transaction Breakdown',
                    data: {!! json_encode($transactionBreakdownData) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        const revenueDistributionChart = new Chart(revenueDistributionCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($revenueDistributionLabels) !!},
                datasets: [{
                    label: 'Revenue Distribution',
                    data: {!! json_encode($revenueDistributionData) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        const productSalesChart = new Chart(productSalesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($productSalesLabels) !!},
                datasets: [{
                    label: 'Product Sales',
                    data: {!! json_encode($productSalesData) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: { beginAtZero: true },
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection
