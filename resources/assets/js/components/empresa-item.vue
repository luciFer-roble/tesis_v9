<template>
    <tr v-show="!borrado">
        <td>{{ empresa.nombreempresa }}</td>
        <td>{{ empresa.direccionempresa }}</td>
        <td>{{ empresa.sectorempresa }}</td>
        <td>{{ empresa.telefonoempresa }}</td>
        <td><button class="btn btn-link"  >{{ convenio }}</button></td>
        <td>{{ sede }}</td>
        <td>
            <div class="row">
                    <button  type="button" class="btn btn-success" @click="tutores">
                    Ver Tutores
                    </button>
            </div>

        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            empresa: {
                type: Object
            },
            convenios: {
                type: Array
            }
        },
        data:()=>({
            borrado: false,
            convenio: '',
            sede: '',
            codigo: ''
        }),

        methods:{
            descargar:function () {
                axios({
                    url: '/convenios/'+this.codigo+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.convenio); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                       // window.open('/formatos/'+this.formato.idformato+'/descargar/');

            })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
/*            eliminar:function () {
                axios({
                    url: '/convenios/'+this.convenio.idconvenio,
                    method: 'DELETE'
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                        console.log(error);
                    });

                this.borrado = true;
            },*/
            tutores:function () {
                window.location.href = '/tutores/'+this.empresa.idempresa+'/list';
            }
        },

        mounted(){
            for (let i = 0; i< Object.keys(this.convenios).length; i++){
               if (this.convenios[i].idempresa == this.empresa.idempresa){
                   this.convenio = this.convenios[i].archivoconvenio;
                   this.sede = this.convenios[i].sede.nombresede;
                   this.codigo = this.convenios[i].idconvenio;
               }
            }
        }
    }
</script>

<style scoped>

</style>