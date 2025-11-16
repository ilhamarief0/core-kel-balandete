const chart = document.getElementById('myChart');

new Chart(chart, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [114210, 97200, 24300, 7290],
            backgroundColor: [
                '#34613A',
                '#8EBD55',
                '#FA7139',
                '#FBAD48',
            ],
        }]
    },
    options: {
        scales: {
            display: false
        },
        datasets: {
            doughnut: {
                spacing: 2,
                borderRadius: 6,
                cutout: '69%',
            }
        },
    }
});