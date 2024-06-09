@extends('layouts.adminapp')

@section('content')
<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <h3>Transaction History</h3>
            <canvas id="transactionHistoryChart"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Transaction Breakdown</h3>
            <canvas id="transactionBreakdownChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transactionHistoryCtx = document.getElementById('transactionHistoryChart').getContext('2d');
        const transactionBreakdownCtx = document.getElementById('transactionBreakdownChart').getContext('2d');

        const transactionHistoryChart = new Chart(transactionHistoryCtx, {
            type: 'line',
            data: {
                labels: @json($transactionHistoryLabels),
                datasets: [{
                    label: 'Transactions Over Time',
                    data: @json($transactionHistoryData),
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
                labels: @json($transactionBreakdownLabels),
                datasets: [{
                    label: 'Transaction Breakdown',
                    data: @json($transactionBreakdownData),
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
    });
</script>
@endsection
