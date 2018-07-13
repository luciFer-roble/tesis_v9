<template>
    <tr >
        <td v-model="descripcion">
            {{ descripcion }}
        </td>
        <td class="p-0 m-0" v-if="!mostrar">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class=""  name="archivo" id="archivo">
                    <label class="" for="archivo"></label>
                </div>
            </div>
        </td>
        <td class="p-0 m-0" v-if="mostrar">
            <button class="btn btn-link"  >{{ archivo }}</button>
        </td>
        <td><div class="form-check">
            <label>
                <input class="form-control custom-checkbox " type="checkbox"   :disabled="true" >

            </label>
        </div></td>
    </tr>
</template>

<script>
    export default {
        props: {
            tipo: {
                type: Object
            },
            practica: String,
            documento: String
        },

        data:()=>({
            descripcion: '',
            archivo: '',
            mostrar: false
        }),
        created() {
            this.descripcion = this.tipo.descripciontipodocumento;
            this.archivo=this.documento;
            if(this.documento != ''){
                this.mostrar = true;
            }
        }
    }
</script>

<style scoped>

</style>