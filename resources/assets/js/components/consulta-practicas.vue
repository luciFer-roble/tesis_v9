<template>
    <!-- DataTable Card-->
    <div class="card mb-3">
        <div class="card-header ">
            <div class="form-inline mr-2">
                <select  class="form-control" v-model="criterio" @change="cargarselect">
                    <option value="0">-Seleccione-</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="profesor">Tutor Academico</option>
                    <option value="periodo">Periodo Academico</option>
                    <option value="empresa">Empresa</option>
                    <option value="nivel">Nivel</option>
                </select>
                <span>&nbsp; </span>
                <input class=" form-control" :disabled="isperiodo || isnivel || isempresa" type="search" v-model="parametro" @keyup="cargardatos" placeholder="Buscar..." aria-label="Search">
                <span>&nbsp;  o &nbsp; </span>
                <select class="form-control float-right" :disabled="criterio === 'estudiante' || criterio === 'profesor'" v-model="parametro2" @change="cargardatos2">
                    <option value="0">-Seleccione-</option>
                    <option v-if="isperiodo" v-for="item in lista2" :value="item.idperiodoacademico">{{ item.facultad.nombrefacultad+' '+item.nombreperiodoacademico}}</option>
                    <option v-if="isempresa" v-for="item in lista2" :value="item.idempresa">{{ item.nombreempresa }}</option>
                    <option v-if="isnivel" v-for="item in lista2" :value="item.idnivel">{{ item.nombrenivel }}</option>
                </select>
            </div>
        </div>
        <div class="card-body" id="app">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr v-show="check">
                        <th class="m-0 p-0">No.</th>
                        <th class="m-0 p-0">Estudiante</th>
                        <th class="m-0 p-0">Inicio</th>
                        <th class="m-0 p-0">Fin</th>
                        <th class="m-0 p-0">Tipo de proyecto</th>
                        <th class="m-0 p-0"># Horas</th>
                        <th class="m-0 p-0">Empresa</th>
                        <th class="m-0 p-0">Tipo Empresa</th>
                        <th class="m-0 p-0">Sector</th>
                        <th class="m-0 p-0">Tutor Academico</th>
                        <th class="m-0 p-0">Tutor Empresarial</th>
                    </tr>
                    <tr v-show="vacio">
                        No se encontraron coincidencias
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in lista">

                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.idpractica }}</span></td>
                        <td class="m-0 p-0"> <button  @click="verestudiante(item.idestudiante)" class="btn btn-link m-0 p-0 border-0" >{{ item.nombresestudiante+' '+item.apellidosestudiante}}</button></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechainiciopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechafinpractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.horaspractica }}</span></td>
                        <td class="m-0 p-0"><button  @click="verempresa(item.idempresa)" class="btn btn-link  m-0 p-0"  >{{ item.nombreempresa}}</button></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipoempresa}}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.sectorempresa}}</span></td>
                        <td class="m-0 p-0"><button  @click="verprofesor(item.idprofesor)" class="btn btn-link  m-0 p-0" >{{ item.nombresprofesor+' '+item.apellidosprofesor }}</button></td>
                        <td class="m-0 p-0"><button  @click="vertutore(item.idtutore)" class="btn btn-link  m-0 p-0" >{{ item.nombretutore+' '+item.apellidotutore }}</button></td>

                        <td class="m-0 p-0">

                            <button  type="button" class="btn btn-block btn-outline-success m-0 p-1 border-0" @click="editar(item.idpractica)">
                                <i class="fa fa-external-link-alt"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

            <!--MODAL ESTUDIANTE-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modalestudiante">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{estudiante.apellidosestudiante+' '+estudiante.nombresestudiante }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Carrera:</strong> {{ estudiante.nombrecarrera }}<br>
                                <strong>Cedula:</strong> {{ estudiante.cedulaestudiante }}<br>
                                <strong>Celular:</strong> {{ estudiante.celularestudiante }}<br>
                                <strong>Correo Electronico:</strong> {{ estudiante.correoestudiante }}<br>
                                <strong>Fecha de Nacimiento:</strong> {{ estudiante.fechanacimientoestudiante }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL empresa-->
            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" ref="modalempresa">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">{{estudiante.apellidosestudiante+' '+estudiante.nombresestudiante }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Carrera:</strong> {{ estudiante.nombrecarrera }}<br>
                                <strong>Cedula:</strong> {{ estudiante.cedulaestudiante }}<br>
                                <strong>Celular:</strong> {{ estudiante.celularestudiante }}<br>
                                <strong>Correo Electronico:</strong> {{ estudiante.correoestudiante }}<br>
                                <strong>Fecha de Nacimiento:</strong> {{ estudiante.fechanacimientoestudiante }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL profesor-->
            <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" ref="modalprofesor">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel3">{{estudiante.apellidosestudiante+' '+estudiante.nombresestudiante }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Carrera:</strong> {{ estudiante.nombrecarrera }}<br>
                                <strong>Cedula:</strong> {{ estudiante.cedulaestudiante }}<br>
                                <strong>Celular:</strong> {{ estudiante.celularestudiante }}<br>
                                <strong>Correo Electronico:</strong> {{ estudiante.correoestudiante }}<br>
                                <strong>Fecha de Nacimiento:</strong> {{ estudiante.fechanacimientoestudiante }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--MODAL turore-->
            <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true" ref="modaltutore">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel4">{{estudiante.apellidosestudiante+' '+estudiante.nombresestudiante }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <strong>Carrera:</strong> {{ estudiante.nombrecarrera }}<br>
                                <strong>Cedula:</strong> {{ estudiante.cedulaestudiante }}<br>
                                <strong>Celular:</strong> {{ estudiante.celularestudiante }}<br>
                                <strong>Correo Electronico:</strong> {{ estudiante.correoestudiante }}<br>
                                <strong>Fecha de Nacimiento:</strong> {{ estudiante.fechanacimientoestudiante }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</template>

<script>
    export default {
        name: "consulta-practicas",
        data:()=>({
            lista:[],
            criterio:'estudiante',
            parametro:'',
            check: false,
            vacio: false,
            lista3:[],
            lista2:[],
            criterio2:'0',
            parametro2:'0',
            isperiodo: false,
            isempresa: false,
            isnivel: false,
            estudiante: Object,
            empresa: Object,
            profesor: Object,
            tutore: Object
        }),
        methods:{
            verestudiante:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getestudiante',{
                    params:{'id':id}
                }).then((response)=>{
                    this.estudiante=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalestudiante).modal('show');
            },
            verempresa:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getempresa',{
                    params:{'id':id}
                }).then((response)=>{
                    this.estudiante=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalempresa).modal('show');
            },
            verprofesor:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getprofesor',{
                    params:{'id':id}
                }).then((response)=>{
                    this.estudiante=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalprofesor).modal('show');
            },
            vertutore:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/gettutore',{
                    params:{'id':id}
                }).then((response)=>{
                    this.estudiante=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modaltutore).modal('show');
            },
            cargardatos:function () {
                axios.get(window.location.origin+'/api/consultar-practicas',{
                    params:{'criterio':this.criterio,
                        'parametro': this.parametro}
                }).then((response)=>{
                    this.lista=response.data;
                    if(Object.keys(this.lista).length === 0){
                        this.check = false;
                        this.vacio = true;
                    }else{
                        this.check = true;
                        this.vacio = false;
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },

            cargardatos2:function () {
                axios.get(window.location.origin+'/api/consultar2-practicas',{
                    params:{'criterio':this.criterio,
                        'parametro': this.parametro2}
                }).then((response)=>{
                    this.lista=response.data;
                    if(Object.keys(this.lista).length === 0){
                        this.check = false;
                        this.vacio = true;
                    }else{
                        this.check = true;
                        this.vacio = false;
                        this.parametro2
                    }
                }).catch(function (error) {
                    console.log(error);
                });



            },
            mostrartodo:function () {
                axios.get(window.location.origin+'/api/todo-practicas'
                ).then((response)=>{
                    this.lista=response.data;
                    if(Object.keys(this.lista).length === 0){
                        this.check = false;
                        this.vacio = true;
                    }else{
                        this.check = true;
                        this.vacio = false;
                    }
                }).catch(function (error) {
                    console.log(error);
                });



            },

            cargarselect:function () {
                console.log(this.criterio);
                if(this.criterio === 'empresa'){
                    this.isempresa = true;
                    this.isperiodo = false;
                    this.isnivel = false;
                }
                else {
                    if (this.criterio === 'periodo'){
                        this.isempresa = false;
                        this.isperiodo = true;
                        this.isnivel = false;
                    }
                    else {
                        if (this.criterio === 'nivel'){
                            this.isempresa = false;
                            this.isperiodo = false;
                            this.isnivel = true;
                        }
                        else {
                            this.isempresa = false;
                            this.isperiodo = false;
                            this.isnivel = false;
                        }
                    }
                }
                axios.get(window.location.origin+'/api/listar-select1',{
                    params:{'criterio':this.criterio}
                }).then((response)=>{
                    this.lista2=response.data;
                    if(this.isnivel){
                        this.parametro2 =this.lista2[0].idnivel;
                    }
                    if(this.isperiodo){
                        this.parametro2 =this.lista2[0].idperiodoacademico;
                    }
                    if(this.isempresa){
                        this.parametro2 =this.lista2[0].idempresa;
                    }
                }).catch(function (error) {
                    console.log(error);
                });

            },
            editar:function (id) {
                window.location.href = '/practicas/'+id+'/edit';
            }
        },
        created() {
            this.mostrartodo();
        }
    }
</script>

<style scoped>

</style>