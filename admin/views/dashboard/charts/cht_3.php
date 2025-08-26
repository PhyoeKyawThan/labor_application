<div class="chart-card">
    <h3>အလုပ်ရရှိသူများ၏ အသက်အပိုင်းအခြားအလိုက် ဖော်ပြသည့်ဇယား</h3>
    <canvas id="ageGapChart"></canvas>
</div>

<script>
    const employedChart = new Chart(document.getElementById('ageGapChart'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($employed_labels) ?>,
            datasets: [{
                data: <?= json_encode($employed_data) ?>,
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