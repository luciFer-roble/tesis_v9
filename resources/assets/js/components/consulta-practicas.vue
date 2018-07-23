<template>
    <!-- DataTable Card-->
    <div class="card mb-3">
        <div class="card-header ">
            <div class="form-inline mr-2">
                <select  class="form-control" v-model="criterio">
                    <option value="0">-Seleccione-</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="profesor">Tutor Academico</option>
                </select>
                <input  class=" form-control" type="search" v-model="parametro" @keyup="cargardatos" placeholder="Buscar..." aria-label="Search">
            </div>
        </div>
        <div class="card-body" id="app">
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr v-show="check">
                        <th>Codigo</th>
                        <th>Estudiante</th>
                        <th>Empresa</th>
                        <th>Tutor Academico</th>
                        <th>Tutor Empresarial</th>
                        <th>Tipo</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>En curso</th>
                    </tr>
                    <tr v-show="vacio">
                        No se encontraron coincidencias
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in lista">

                        <td>{{ item.idpractica }}</td>
                        <td> <a  class="btn btn-link" :href="'/estudiantes/' + item.idestudiante" >{{ item.nombre1estudiante+' '+item.apellido1estudiante}}</a></td>
                        <td><a  class="btn btn-link" :href="'/empresas/' + item.idempresa" >{{ item.nombreempresa}}</a></td>
                        <td><a  class="btn btn-link" :href="'/profesores/' + item.idprofesor" >{{ item.nombre1profesor+' '+item.apellido1profesor }}</a></td>
                        <td><a  class="btn btn-link" :href="'/tutores/' + item.idtutore" >{{ item.nombretutore+' '+item.apellidotutore }}</a></td>
                        <td>{{ item.tipopractica }}</td>
                        <td>{{ item.fechainiciopractica }}</td>
                        <td>{{ item.fechafinpractica }}</td>
                        <td>{{ item.activapractica }}</td>
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
            vacio: false
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

            }
        }
    }
</script>

<style scoped>

</style>