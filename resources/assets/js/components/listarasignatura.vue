<template>
<div>
<select  class="form-control" v-model="seleccionado" >
 <option :key="item.idasignatura" v-for="item in lista2" :value="item.idasignatura">{{item.nombreasignatura}}</option>
  </select>
    <button type="button" v-on:click="cargardatos" >
        cargar
    </button>
  </div>

</template>

<script>
    export default{
        props:['codigo'],
        name:'fer',
        data:()=>({
            lista2:[],
            seleccionado:''
        }),
        methods:{
            cargardatos:function () {
                console.log('fer');
                axios.get(window.location.origin+'/api/lista_asignaturas',{
                    params:{'idcarrera':this.codigo}
                }).then((response)=>{
                    this.lista2=response.data;
                    console.log(this.lista2[0].nombreasignatura);
                })

            }
        },
        created(){
           this.cargardatos();
        }
    }
</script>