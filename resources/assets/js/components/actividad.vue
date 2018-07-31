<template>
    <tr >
        <td style="width:  12%">
            <input class="form-control" type="date" name="fecha" id="fecha"  v-model="fecha" @blur="insertar" :disabled="check">
        </td>
        <td class="p-0 m-0">
            <textarea class="form-control " name="descripcion" id="descripcion" cols="30"  v-model="descripcion" @blur="insertar" :disabled="check"></textarea>
        </td>
        <td style="width:  7%"><div class="form-check">
            <label>
                <input class="form-control custom-checkbox " type="checkbox"  v-model="check" :disabled="check" @change="insertar">

            </label>
        </div></td>
        <td>
            <input class="form-control" type="text" name="comentario" id="comentario" v-model="comentario" @blur="insertar" :disabled="check">
        </td>

        <td style="width:  6%">
            <input class="form-control" type="text" name="horas" id="horas" v-model="horas" @blur="insertar" :disabled="false">
        </td>
    </tr>
</template>

<script>
    export default {

        props: {
            actividad: {
                type: Object
            }
        },
        data:()=>({
            fecha: '',
            descripcion: '',
            comentario: '',
            check: '',
            horas: ''
        }),
        methods:{
            insertar:function () {
                axios.put('/actividades/'+this.actividad.idactividad, {
                    fecha: this.fecha,
                    descripcion: this.descripcion,
                    comentario: this.comentario,
                    estado: this.check,
                    horas: this.horas
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        },
        created() {
            console.log(this.actividad.idactividad);
            this.fecha = this.actividad.fechaactividad;
            this.descripcion = this.actividad.descripcionactividad;
            this.comentario = this.actividad.comentarioactividad;
            this.check = this.actividad.estadoactividad;
            this.horas = this.actividad.horasactividad;
        }
    }
</script>