var ch = document.getElementById('chart').getContext('2d');
var myBarChart = new Chart(ch, {
    type: 'bar',
    data: {
        labels: ['Dany', 'Seba', 'Del'],
        datasets: [{
                label: 'EMPLEADOS',
                data: [45, 20, 30],
                backgroundColor: ['#000fff56', '#ae678956', '#356ff56'],
                borderColor: ['#000fff', '#ae6789', '#3456ff'],
                borderWidth: 2
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

