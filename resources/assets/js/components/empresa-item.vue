<template>
    <table class="table table-bordered p-0 m-0" style="table-layout: fixed">
    <tr style="background-color: white">
        <th  style="width:  14%; background-color:  #007bff ; color: white; text-align: center" class="p-1 m-0">{{ empresa.nombreempresa }}</th>
        <td  style="width:  18%"class="p-1 m-0">{{ empresa.direccionempresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.sectorempresa }}</td>
        <td  style="width:  10%" class="p-1 m-0">{{ empresa.telefonoempresa }}</td>
        <td  style="width: 1.7%"class="p-0 m-0" v-if="convenio"><button class="btn btn-link" v-model="convenio.archivoconvenio" :title="convenio" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
        </button></td>
        <td  style="width:  1.7%"class="p-0 m-0" v-else-if="!convenio"><button class="btn btn-link" @click="agregar_convenio" ><i class="fa fa-plus"></i></button></td>
        <td style="width:  8%" class="p-1 m-0">{{ sede }}</td>
        <td style="width: 2%" v-if="!tutores" class="p-1 m-0"><i @click="vertutores" class="fa fa-angle-down "></i></td>
        <td style="width: 2%" v-if="tutores" class="p-1 m-0"><i @click="ocultartutores" class="fa fa-angle-up "></i></td>

    </tr>
    <tr>
        <td v-if="llena" v-show="tutores" colspan="7" class="p-0 m-0">
            <table class="table table-bordered p-0 m-0">
                <thead>
                <tr style="background-color: #F2F2F2">
                    <th class="p-1 m-0">Nombre</th>
                    <th class="p-1 m-0">Apellido</th>
                    <th class="p-1 m-0">Celular</th>
                    <th class="p-1 m-0">Correo</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in lista">
                    <td class="p-1 m-0">{{item.nombretutore}}</td>
                    <td class="p-1 m-0">{{item.apellidotutore}}</td>
                    <td class="p-1 m-0">{{item.celulartutore}}</td>
                    <td class="p-1 m-0">{{item.correotutore}}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </table>
</template>

<script>
    export default {
        props: {
            empresa: {
                type: Object
            },
            convenios: {
                type: Array
            },
            /*tutores: {
                type: Array
            },*/
            hastutores:{
                type:String
            }
        },
        data:()=>({
          lista:[],
          tutores: false,
            llena:false,
            borrado: false,
            convenio: '',
            sede: '',
            codigo: '',
            excel: false,
            pdf: false,
            doc: false
        }),

        methods:{
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-tutores-por-empresa',{
                    params:{'idempresa':this.empresa.idempresa}
                }).then((response)=>{
                    this.lista=response.data;
                    if(this.lista.length>0){
                        this.llena=true;
                    }
                    else{
                        this.llena=false;
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            agregar_convenio:function () {
                window.location.href = '/convenios/'+this.empresa.idempresa+'/create1';
            },
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
        vertutores:function() {
            this.tutores = true;
        },
        ocultartutores:function() {
            this.tutores = false;
        }
        },

        created() {
            this.cargardatos();
        },
        mounted(){
            for (let i = 0; i< Object.keys(this.convenios).length; i++){
               if (this.convenios[i].idempresa == this.empresa.idempresa){
                   this.convenio = this.convenios[i].archivoconvenio;
                   this.sede = this.convenios[i].sede.nombresede;
                   this.codigo = this.convenios[i].idconvenio;

                   if(this.convenio.split('.')[1] === 'xlsx'){
                       this.excel = true;
                       this.pdf = false;
                       this.doc = false;
                   }
                   if(this.convenio.split('.')[1] === 'pdf'){
                       this.excel = false;
                       this.pdf = true;
                       this.doc = false;
                   }
                   if(this.convenio.split('.')[1] === 'doc' || this.convenio.split('.')[1] === 'docx'){
                       this.excel = false;
                       this.pdf = false;
                       this.doc = true;
                   }


               }
            }
        }
    }
</script>

<style scoped>

</style>