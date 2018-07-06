<template>
<table width="100%">
 <tbody>
 <tr>
 </tr>
 <tr v-for="(row, index) in rows" class="d-flex">
  <td class="col-6">
    <label v-model="row.title">{{ row.title }}</label>
  </td>
  <td class="col-6">
  <select  class="form-control" v-model="seleccionado" @change="addrow">
   <option  :key="item.idasignatura" v-for="item in lista2" :value="item.idasignatura">{{item.nombreasignatura}}</option>
  </select>
  </td>
 </tr>
 </tbody>
  </table>
</template>
<script>
    export default{
        props:['codigo', 'estudiante'],
        name:'fer',
        data:()=>({
            lista2:[],
            seleccionado:'',
            rows: [{
                title: 'Asignatura',
                description: ''
            }]
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

            },
            addrow:function (e) {
                e.preventDefault()
                var elem = document.createElement('tr');
                this.rows.push({
                    title: "Asignatura",
                    description: ""
                });

                axios.post('/estasignaturas', {
                    estudiante: this.estudiante,
                    asignatura: this.seleccionado
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        },
        created(){
           this.cargardatos();
        }
    }
</script>