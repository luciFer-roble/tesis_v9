    <template>
    <tr v-show="!borrado">
        <td>{{ formato.idtipodocumento }}</td>
        <td>{{ descripcion }}</td>
        <td><button class="btn btn-link" v-model="formato.archivoformato" @click="descargar">{{ formato.archivoformato}}</button></td>
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
            formato: {
                type: Object
            },
            descripcion: String
        },
        data:()=>({
            borrado: false
        }),
        methods:{
            descargar:function () {
                axios({
                    url: '/formatos/'+this.formato.idformato+'/descargar',
                    method: 'GET',
                    responseType: 'blob'
            }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.formato.archivoformato); //or any other extension
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
                    url: '/formatos/'+this.formato.idformato,
                    method: 'DELETE'
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                        console.log(error);
                    });

                this.borrado = true;
            },
            editar:function () {
                window.location.href = '/formatos/'+this.formato.idformato+'/edit';
            }
        }
    }
</script>

<style scoped>

</style>