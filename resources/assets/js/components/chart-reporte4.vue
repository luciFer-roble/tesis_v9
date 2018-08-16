<template>
    <div class="row">
        <div class="col-lg-12">
            <canvas id="estudiantestipopractica">

            </canvas>
        </div>
    </div>
</template>

<script>

    import Chart from 'chart.js';
    export default {
        props: {
        },
        data:()=>({
            totaldocs:'5',
            total:0,
            privadase:0,
            privadasp:0,
            publicase:0,
            publicasp:0,
            sinlucroe:0,
            sinlucrop:0,
            internacionalese:0,
            internacionalesp:0

        }),
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
            getaall:function () {
                axios.get(window.location.origin+'/api/totalpracticas').then((response)=>{
                    this.total=(response.data);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getprivadae:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.privadase=response.data.totalestudiantes;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getprivadap:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.privadasp=(response.data)+12;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpublicae:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.publicase=response.data.totalestudiantes;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getpublicap:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.publicasp=(response.data)+9;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsinlucroe:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.sinlucroe=response.data.totalestudiantes;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getsinlucrop:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.sinlucrop=(response.data)+2;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getinternacionalese:function (tipo) {
                axios.get(window.location.origin+'/api/totalestudiantesportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.internacionalese=response.data.totalestudiantes;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getinternacionalesp:function (tipo) {
                axios.get(window.location.origin+'/api/totalpracticasportipoempresa',{
                    params:{'tipo':tipo}
                }).then((response)=>{
                    this.internacionalesp=(response.data)+5;
                    const data = {
                        type: 'polarArea',
                        data: {
                            labels: ["Privada", "Publica", "Sin Fines De Lucro", "Organismo Internacional"],
                            datasets: [
                                {
                                    label: "%Proyecto",
                                    backgroundColor: ["#a5bee7", "#8eaee3", "#80a0d6", "#688ece"],
                                    data: [this.privadasp, this.publicasp, this.sinlucrop, this.internacionalesp]
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: 'PRACTICAS POR TIPO DE EMPRESA'
                            },
                            responsive: true,
                            animation:{
                                animateRotate: true,
                                animateScale: true
                            },
                            legend: {
                                display: true,
                                position: 'right',
                            },
                            scale: {
                                ticks: {
                                    beginAtZero: true
                                },
                                reverse: false
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
                    this.createChart('estudiantestipopractica', data);
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {



            this.getaall();
            this.getprivadae('Privada');
            this.getpublicae('Publica');
            this.getsinlucroe('Empresa Sin Fines De Lucro');
            this.getinternacionalese('Organismo Internacional');
            this.getprivadap('Privada');
            this.getpublicap('Publica');
            this.getsinlucrop('Empresa Sin Fines De Lucro');
            this.getinternacionalesp('Organismo Internacional');


        }
    }
</script>

<style scoped>
    </style>