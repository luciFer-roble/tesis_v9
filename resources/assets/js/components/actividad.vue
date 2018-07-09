<template>
    <tr >
        <td>
            <input class="form-control" type="date" name="fecha" id="fecha" v-model="actividad.fechaactividad">
        </td>
        <td class="p-0 m-0">
            <textarea class="form-control " name="descripcion" id="descripcion" cols="30" v-model="actividad.descripcionactividad"></textarea>
        </td>
        <td>
        </td>
        <td>
            <input class="form-control custom-checkbox " type="checkbox">
        </td>
        <td>
            <input class="form-control" type="text">
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
        created() {
            console.log(this.actividad);
        }
    }
</script>