<template>
    <tr>
        <td class="p-0 m-0">{{ carrera.nombrecarrera }}</td>
        <td class="p-0 m-0" style="width: 35%;">{{ profesor.nombresprofesor }} {{profesor.apellidosprofesor }}</td>
        <td class="p-0 m-0">{{ coordinador.fechainiciocoordinador }}</td>
        <td class="p-0 m-0">{{ coordinador.fechafincoordinador }}</td>

        <td class="p-0 m-0" style="width: 7%">

            <div class="row p-0 m-0"  >
                <div class="col"  >
                    <span   class="btn btn-link p-0 m-0">

                     <i  class="fa fa-external-link-alt" @click="verprofesor(coordinador.idprofesor)" title="Ver Coordinador"></i>
                    </span>
                </div>

                <div class="col" >
                    <span   class="btn text-danger p-0 m-0">
                        <i  class="fa fa-toggle-off" title="Cambiar de Coordinador" @click="cambiarcoordinador(coordinador.idcoordinador)"></i>
                    </span>
                </div>
            </div>

        </td>


        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" ref="modalprofesor">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">{{profesor.apellidosprofesor+' '+profesor.nombresprofesor }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Escuela:</strong> {{ profesor.nombreescuela }}<br>
                            <strong>Celular:</strong> {{ profesor.celularprofesor }}<br>
                            <strong>Correo Electronico:</strong> {{ profesor.correoprofesor }}<br>
                            <strong>Oficina:</strong> {{ profesor.oficinaprofesor }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </tr>
</template>

<script>
    export default {
        name: "coordinador-componente",
        props: {
            carrera: {
                type: Object
            },

            profesor: {
                type: Object
            },
            coordinador: {
                type: Object
            }
        },
        methods:{
            verprofesor:function (id) {
                console.log(id);
                axios.get(window.location.origin+'/api/getprofesor',{
                    params:{'id':id}
                }).then((response)=>{
                    this.profesor=response.data;
                }).catch(function (error) {
                    console.log(error);
                });

                $(this.$refs.modalprofesor).modal('show');
            },
            cambiarcoordinador:function (id) {
                window.location.href = '/coordinadores/'+id+'/change';
            }

        },
        created() {

        }
    }
</script>

<style scoped>

</style>