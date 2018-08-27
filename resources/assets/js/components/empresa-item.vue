<template>
    <div>
    <table class="table table-bordered p-0 m-0" style="table-layout: fixed">
    <tr style="background-color: white">
        <th  style="width:  14%; background-color:  #007bff ; color: white; text-align: center" class="p-1 m-0">{{ empresa.nombreempresa }}</th>
        <td  style="width:  18%"class="p-1 m-0">{{ empresa.direccionempresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.tipoempresa }}</td>
        <td  style="width:  10%"class="p-1 m-0">{{ empresa.sectorempresa }}</td>
        <td  style="width:  10%" class="p-1 m-0">{{ empresa.telefonoempresa }}</td>
        <td style="width:  7%" class="p-1 m-0">{{ sede }}</td>
        <td  style="width: 2.2%"class="p-0 m-0" v-if="convenio"><button class="btn btn-link" :title="convenio" @click="descargar">
            <i v-if="excel" class=" text-success far fa-file-excel"></i>
            <i v-if="pdf" class=" text-danger far fa-file-pdf"></i>
            <i v-if="doc" class="far fa-file-word"></i>
        </button></td>
        <td  style="width: 2.2%"class="p-0 m-0" v-else-if="!convenio"><button class="btn btn-link" @click="agregar_convenio" title="AÑADIR CONVENIO" ><i class="fa fa-plus"></i></button></td>
        <td style="width: 2.2%" class="p-0 m-0"><button class="btn btn-link" @click="edit" title="EDITAR"><i class="text-info fa fa-pencil-alt"></i></button></td>
        <td style="width: 2.2%" class="p-0 m-0"><button class="btn btn-link" @click="agregartutor" title="AÑADIR TUTOR"><i class=" text-info fas fa-user-plus"></i></button></td>
        <td style="width: 1%" v-if="!tutores" class="p-1 m-0"><i @click="vertutores" class="fa fa-angle-down "></i></td>
        <td style="width: 1%" v-if="tutores" class="p-1 m-0"><i @click="ocultartutores" class="fa fa-angle-up "></i></td>
    </tr>
    <tr>
        <td v-if="llena" v-show="tutores" colspan="10" class="p-0 m-0">
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

        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modaledit">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group" v-if="mostrar">
                            <div class="alert alert-danger" style="opacity: 0.7 !important;">
                                <ul v-for="error in errors">
                                    <li>{{ error[0]  }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="formgroup">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombre" name="nombre">
                            </div>

                            <div class="formgroup">
                                <label>Direccion:</label>
                                <input type="text" class="form-control" v-model="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label>Tipo:</label>
                                <select v-model="tipo" name="tipo" class="form-control">
                                    <option value="Publica">Publica</option>
                                    <option value="Privada">Privada</option>
                                    <option value="Sin fines de lucro">Sin fines de lucro</option>
                                    <option value="Organismo Internacional">Organismo Internacional</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Sector:</label>
                                <select v-model="sector" name="sector" class="form-control">
                                    <option value="Primario">PRIMARIO (Agricultura, Ganadería, Pesca, Minería)</option>
                                    <option value="Secundario">SECUNDARIO (Industria, Construcción)</option>
                                    <option value="Terciario">TERCIARIO (Comercio, Servicios)</option>
                                </select>
                            </div>
                            <div class="formgroup">
                                <label>Telefono:</label>
                                <input type="text" class="form-control" v-model="telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  @click="update" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }"  class="btn " >{{ boton1 }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" ref="modaltutore">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Nuevo Tutor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" v-if="mostrar">
                            <div class="alert alert-danger" style="opacity: 0.7 !important;">
                                <ul v-for="error in errors">
                                    <li>{{ error[0]  }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="formgroup" width="100%">
                                <label>Empresa:</label>
                                <input type="text" class="form-control" :value="empresa.nombreempresa" name="empresa" disabled>
                            </div>
                            <div class="formgroup" width="100%">
                                <label>Cedula:</label>
                                <input type="text" class="form-control" v-model="cedula" name="cedula">
                            </div>
                            <div class="formgroup" width="100">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" v-model="nombretutor" name="nombre">
                            </div>

                            <div class="formgroup">
                                <label>Apellido:</label>
                                <input type="text" class="form-control" v-model="apellido" name="apellido">
                            </div>

                            <div class="formgroup">
                                <label>Celular:</label>
                                <input type="text" class="form-control" v-model="celular" name="celular">
                            </div>

                            <div class="formgroup">
                                <label>Correo:</label>
                                <input type="text" class="form-control" v-model="correo" name="correo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-light" data-dismiss="modal" v-bind:class="{ disabled: actualizando }" >Cancelar</a>
                        <button type="button"  @click="save" v-bind:class="{ disabled: actualizando, 'btn-secondary': actualizando, 'btn-primary' : !actualizando }"  class="btn " >{{ boton2 }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            doc: false,
            actualizando: false,
            errors: [],
            mostrar: false,
            nombre: '',
            direccion: '',
            tipo: '',
            sector: '',
            telefono: '',
            boton1: 'Actualizar',
            cedula:'',
            nombretutor: '',
            apellido: '',
            celular: '',
            correo: '',
            boton2: 'Guardar'
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
            },
            edit:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                this.nombre =this.empresa.nombreempresa;
                this.direccion = this.empresa.direccionempresa;
                this.tipo = this.empresa.tipoempresa;
                this.sector = this.empresa.sectorempresa;
                this.telefono = this.empresa.telefonoempresa;
                $(this.$refs.modaledit).modal('show');
            },
            agregartutor:function () {
                this.errors = [];
                this.mostrar = false;
                this.actualizando = false;
                $(this.$refs.modaltutore).modal('show');
            },

            update:function () {
                this.actualizando = true;
                this.boton1 = 'Actualizando';
                axios.put('/empresas/'+this.empresa.idempresa, {
                    nombre: this.nombre,
                    direccion: this.direccion,
                    tipo: this.tipo,
                    sector: this.sector,
                    telefono: this.telefono
                })
                    .then(function (response) {
                        //$(this.$refs.modaledit).modal('hide');
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.actualizando = false;
                        this.boton1 = 'Actualizar';
                        module.status = error.response.data.status;
                        this.errors = error.response.data;
                        this.mostrar = true;
                    });


            },
            save: function () {
                this.actualizando = true;
                this.boton2 = 'Guardando';
                axios.post('/tutores/', {
                    cedula: this.cedula,
                    nombre: this.nombretutor,
                    apellido: this.apellido,
                    celular: this.celular,
                    correo: this.correo,
                    empresa: this.empresa.idempresa
                })
                    .then(function (response) {
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.actualizando = false;
                        this.boton2 = 'Guardar';
                        module.status = error.response.data.status;
                        this.errors = error.response.data;
                        this.mostrar = true;
                    });

                this.gettutores();
                $(this.$refs.vuemodal).modal('hide');
            },
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
                   console.log(this.convenios[i].sede.nombresede);
                   console.log(this.convenios[i].archivoconvenio);
                   console.log(this.convenios[i].idconvenio);

                   if(this.convenio.split('.')[1] === 'xlsx' || this.convenio.split('.')[1] === 'XLSX'){
                       this.excel = true;
                       this.pdf = false;
                       this.doc = false;
                   }
                   if(this.convenio.split('.')[1] === 'pdf' || this.convenio.split('.')[1] === 'PDF' ){
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