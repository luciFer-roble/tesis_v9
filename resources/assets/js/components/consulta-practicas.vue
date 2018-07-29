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
                <input  class=" form-control" type="search" v-model="parametro" @keyup="cargardatos" placeholder="Buscar..." aria-label="Search">
                <span>&nbsp;  o &nbsp; </span>
                <select class="form-control float-right" v-model="parametro2" @change="cargardatos2">
                    <option value="0">-Seleccione-</option>
                    <option v-if="isperiodo" v-for="item in lista2" :value="item.idperiodoacademico">{{ item.facultad.nombrefacultad+' '+item.nombreperiodoacademico}}</option>
                    <option v-if="isempresa" v-for="item in lista2" :value="item.idempresa">{{ item.nombreempresa }}</option>
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
                        <td class="m-0 p-0"> <a  class="btn btn-link m-0 p-0 border-0" :href="'/estudiantes/' + item.idestudiante" >{{ item.nombre1estudiante+' '+item.apellido1estudiante+' '+item.apellido2estudiante}}</a></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechainiciopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.fechafinpractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipopractica }}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.horaspractica }}</span></td>
                        <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" :href="'/empresas/' + item.idempresa" >{{ item.nombreempresa}}</a></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.tipoempresa}}</span></td>
                        <td class="m-0 p-0"><span class="btn border-0  m-0 p-0">{{ item.sectorempresa}}</span></td>
                        <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" :href="'/profesores/' + item.idprofesor" >{{ item.nombre1profesor+' '+item.apellido1profesor }}</a></td>
                        <td class="m-0 p-0"><a  class="btn btn-link  m-0 p-0" :href="'/tutores/' + item.idtutore" >{{ item.nombretutore+' '+item.apellidotutore }}</a></td>

                        <td class="m-0 p-0 border-0">

                            <button  type="button" class="btn btn-outline-info m-0 p-0" @click="editar(item.idpractica)">
                                <i class="fa fa-fw fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>

                </table>
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
        }),
        methods:{
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
                }
                else {
                    this.isempresa = false;
                    this.isperiodo = true;
                }
                axios.get(window.location.origin+'/api/listar-select1',{
                    params:{'criterio':this.criterio}
                }).then((response)=>{
                    this.lista2=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

            },
            editar:function (id) {
                window.location.href = '/practicas/'+id+'/edit';
            }
        }
    }
</script>

<style scoped>

</style>