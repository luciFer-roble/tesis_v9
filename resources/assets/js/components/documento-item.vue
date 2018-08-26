    <template>
    <tr v-show="!borrado">
        <td class="p-0 m-0">{{ formato.idtipodocumento }}</td>
        <td class="p-0 m-0">{{ descripcion }}</td>
        <td class="p-0 m-0" style="width:7%"><button class="btn btn-link " v-model="formato.archivoformato" :title="formato.archivoformato" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
        </button></td>
        <td class="p-0 m-0" style="width: 7%">
            <div class="row p-0 m-0">
                <div class="col">
                    <button  type="button" class="btn btn-link p-0 m-0" @click="editar">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                    </button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-link p-0 m-0" @click="eliminar">
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
            borrado: false,
            excel: false,
            pdf: false,
            doc: false
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
        },
        mounted(){
            if(this.formato.archivoformato.split('.')[1] === 'xlsx'){
                this.excel = true;
                this.pdf = false;
                this.doc = false;
            }
            if(this.formato.archivoformato.split('.')[1] === 'pdf'){
                this.excel = false;
                this.pdf = true;
                this.doc = false;
            }
            if(this.formato.archivoformato.split('.')[1] === 'doc' || this.formato.archivoformato.split('.')[1] === 'docx'){
                this.excel = false;
                this.pdf = false;
                this.doc = true;
            }
        }
    }
</script>

<style scoped>

</style>