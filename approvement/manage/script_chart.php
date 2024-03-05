<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['อนุมัติ', 'ไม่อนุมัติ', 'รออนุมัติ'],
        datasets: [{
            label: 'จำนวน',
            data: [<?php echo $count_status_approve?>,
                <?php echo $count_status_reject?>,
                <?php echo $count_status_wait;?>
            ],
            borderWidth: 1,
            backgroundColor: [
                '#B1E6C3',
                '#FFABB0',
                '#D5D5D5'
            ],
        }]
    },
});

const ctx2 = document.getElementById('myChart2');
new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['5', '4.5', '4', '3.5', '3', '2.5', '2', '1.5', '1', '0.5', '0'],
        datasets: [{
            label: 'จำนวนข้อมูล',
            data: [
                <?php echo $count_rating['5'];?>,
                <?php echo $count_rating['4.5'];?>,
                <?php echo $count_rating['4'];?>,
                <?php echo $count_rating['3.5'];?>,
                <?php echo $count_rating['3'];?>,
                <?php echo $count_rating['2.5'];?>,
                <?php echo $count_rating['2'];?>,
                <?php echo $count_rating['1.5'];?>,
                <?php echo $count_rating['1'];?>,
                <?php echo $count_rating['0.5'];?>,
                <?php echo $count_rating['0'];?>,
            ],
            borderWidth: 1,
            backgroundColor: [
                '#B1E6C3',
            ],
        }]
    },
    options: {
        indexAxis: 'y',
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'จำนวน',
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'คะแนน',
                }
            }
        }
    }
});
</script>

<script>
// Sample data for different months and years
const data = {
    <?php
        $stmt = $conn->prepare("
            SELECT DATE_FORMAT(`watch_time`, '%Y-%m') AS times, COUNT(watch_id) as count FROM `watch_log` GROUP by times
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $watchs = $result->fetch_all(MYSQLI_ASSOC);
    ?>
    <?php foreach ($watchs as $watch): ?> '<?php echo $watch['times']?>': <?php echo $watch['count'];?>,
    <?php endforeach; ?>
};

const ctx3 = document.getElementById('barChart').getContext('2d');

// Set the end date input field to the current month and year
const endMonthYearInput = document.getElementById('endMonthYear');
const currentDate = new Date();
const currentYear = currentDate.getFullYear();
const currentMonth = String(currentDate.getMonth() + 1).padStart(2, '0');
endMonthYearInput.value = `${currentYear}-${currentMonth}`;
endMonthYearInput.max = `${currentYear}-${currentMonth}`;

// Initial chart
const chart = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: Object.keys(data),
        datasets: [{
            label: 'จำนวน',
            data: Object.values(data),
            backgroundColor: '#B1E6C3',
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'จำนวน'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'เดือนและปี'
                }
            }
        }
    }
});

// Function to update the chart based on user selection
function updateChart() {
    const startMonthYear = document.getElementById('startMonthYear').value;
    const endMonthYear = document.getElementById('endMonthYear').value;

    // Filter data within the selected month and year range
    const filteredData = {};
    for (const key in data) {
        if (key >= startMonthYear && key <= endMonthYear) {
            filteredData[key] = data[key];
        }
    }

    // Update the chart data and labels
    chart.data.labels = Object.keys(filteredData);
    chart.data.datasets[0].data = Object.values(filteredData);
    chart.update();
}

// Add event listeners to the month and year input fields to update the chart
document.getElementById('startMonthYear').addEventListener('change', updateChart);
document.getElementById('endMonthYear').addEventListener('change', updateChart);

// Initial chart rendering
updateChart();
</script>