<template>
    <tr>
        <td class="p-1 m-0" >{{ estudiante.cedulaestudiante }}</td>
        <td class="p-1 m-0" >{{ estudiante.nombresestudiante }}  {{ estudiante.apellidosestudiante }}</td>
        <td class="p-1 m-0">{{ estudiante.celularestudiante }}</td>
        <td  class="p-1 m-0">{{ estudiante.correoestudiante }}</td>
        <td style="min-width: 90px" class="p-1 m-0">{{ facultad }}</td>
        <td style="min-width: 100px" class="p-1 m-0">{{ carrera }}</td>
        <td  class="p-1 m-0" align="center">{{ estudiante.horasestudiante }}</td>

    </tr>
</template>

<script>
    export default {
        props: {
            estudiante: {
                type: Object
            },
            carrera: String,
            facultad: String
        },
        data:()=>({
            lista:[],
        }),
        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-practicas-por-estudiante',{
                    params:{'idestudiante':this.estudiante.idestudiante}
                }).then((response)=>{
                    this.lista=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

            }

        },
        created() {
            this.cargardatos();
        }
    }
</script>

<style scoped>

</style>