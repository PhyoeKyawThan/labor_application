<div class="chart-card">
    <h3>အသစ်မှတ်ပုံတင်သူများကို အသက်အားဖြင့် ပြသည့်ဇယား</h3>
    <canvas id="newEmployeeChart"></canvas>
</div>
<script>
    const newChart = new Chart(document.getElementById('newEmployeeChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($new_labels) ?>,
            datasets: [{
                data: <?= json_encode($new_data) ?>,
                backgroundColor: [
                    '#42A5F5', '#FF7043',
                    '#64B5F6', '#FF8A65',
                    '#90CAF9', '#FFAB91'
                ]
            }]
        },
        options: {
            responsive: true,
            cutout: '50%',
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });
</script>