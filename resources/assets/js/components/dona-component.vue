<template>
    <canvas id="grafico"></canvas>
</template>

<script>

    import Chart from 'chart.js';
    export default {
        methods: {
            createChart(chartId, chartData) {
                const ctx = document.getElementById(chartId);
                const myChart = new Chart(ctx, {
                    type: chartData.type,
                    data: chartData.data,
                    options: chartData.options,
                });
            }
        },
        mounted() {
            const data = {
                type: 'doughnut',
                data: {
                    labels: ["Completo", "Incompleto"],
                    datasets: [
                        {
                            label: "%Proyecto",
                            backgroundColor: ["#3e95cd","#e8c3b9"],
                            data: [80,20]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '% Proyecto'
                    },
                    responsive: true,
                    cutoutPercentage: 90,
                    legend: {
                        display: false
                    }
                }
            }
            this.createChart('grafico', data);


        }
    }
</script>

<style scoped>

</style>