<template>
    <tr v-show="!borrado">
        <td>{{ empresa.nombreempresa }}</td>
        <td>{{ empresa.direccionempresa }}</td>
        <td>{{ empresa.sectorempresa }}</td>
        <td>{{ empresa.telefonoempresa }}</td>
        <td><button class="btn btn-link" v-model="empresa.archivoconvenio" @click="descargar">{{ empresa.archivoconvenio}}</button></td>
        <td>{{ empresa.nombresede }}</td>
        <td>
            <div class="row">
                <div class="col-sm1">
                    <button  type="button" class="btn btn-link" @click="editar">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </div>
                <div class="col-sm1">
                    <button type="submit" class="btn btn-link" @click="eliminar">
                        <i class="fa fa-fw fa-trash-alt" ></i>
                    </button>
                </div>
            </div>

        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            empresa: {
                type: Object
            }
        },
        data:()=>({
            borrado: false
        })/*,
        methods:{
            descargar:function () {
                axios({
                    url: '/convenios/'+this.convenio.idconvenio+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.convenio.archivoconvenio); //or any other extension
                    document.body.appendChild(link);
                    link.click();

                       // window.open('/formatos/'+this.formato.idformato+'/descargar/');

            })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            eliminar:function () {
                axios({
                    url: '/convenios/'+this.convenio.idconvenio,
                    method: 'DELETE'
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                        console.log(error);
                    });

                this.borrado = true;
            },
            editar:function () {
                window.location.href = '/convenios/'+this.convenio.idconvenio+'/edit';
            }
        }*/
    }
</script>

<style scoped>

</style>