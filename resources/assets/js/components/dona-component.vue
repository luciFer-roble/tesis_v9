<template>
    <div>

        <div class="convas1">
            <canvas id="avancechart">
            </canvas>

            <div class="donut-inner">
                <h5 class="btn text-primary porcentaje" >
                    <button class="btn border-0 btn-link text-primary" @click="actividades">80</button>
                </h5>
            </div>
        </div>
        <div class="convas2">
            <canvas id="documentoschart">
            </canvas>

            <div class="donut-inner">
                <h5 class="btn text-primary porcentaje" >25</h5>
            </div>
        </div>
    </div>
</template>

<script>

    import Chart from 'chart.js';
    export default {
        props: {
            codigo: String
        },
        methods: {
            createChart(chartId, chartData) {
                var canvas = document.getElementById(chartId);
                var ctx = canvas.getContext("2d");
                const myChart = new Chart(ctx, {
                    type: chartData.type,
                    data: chartData.data,
                    options: chartData.options,
                });
            },

            actividades:function () {
                window.location.href = '/actividades/'+this.codigo+'/list';
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
                            backgroundColor: ["#e843b9", "#ddd"],
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
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                            },
                            title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                            }
                        }
                    }
                }
            };
            const data2 = {
                type: 'doughnut',
                data: {
                    labels: ["Completo", "Incompleto"],
                    datasets: [
                        {
                            label: "%Documentos",
                            backgroundColor: ["#3e95cd","#ddd"],
                            data: [25,75]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: '% Documentos'
                    },
                    responsive: true,
                    cutoutPercentage: 90,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                                var total = meta.total;
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = parseFloat((currentValue/total*100).toFixed(1));
                                return currentValue + ' (' + percentage + '%)';
                            },
                            title: function(tooltipItem, data) {
                                return data.labels[tooltipItem[0].index];
                            }
                        }
                    }
                }
            };
            this.createChart('avancechart', data);
            this.createChart('documentoschart', data2);


        }
    }
</script>

<style scoped>
    .donut-inner {
        margin-top: -100px;
        margin-bottom: 100px;
        padding-top: 22px;
        text-align: center;
    }
    .donut-inner h5 {
        margin-bottom: 5px;
        margin-top: 0;
    }
    .donut-inner span {
        font-size: 12px;
    }
</style>