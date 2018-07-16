<template>
    <tr v-show="!borrado">
        <td>{{ convenio.idconvenio }}</td>
        <td>{{ sede }}</td>
        <td>{{ empresa }}</td>
        <td>{{ convenio.descripcionconvenio }}</td>
        <td>{{ convenio.fechainicioconvenio }}</td>
        <td>{{ convenio.fechafinconvenio}}</td>

        <td><button class="btn btn-link" v-model="convenio.archivoconvenio" @click="descargar">{{ convenio.archivoconvenio}}</button></td>
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
            convenio: {
                type: Object
            },
            sede: String,
            empresa: String
        },
        data:()=>({
            borrado: false
        }),
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
        }
    }
</script>

<style scoped>

</style>