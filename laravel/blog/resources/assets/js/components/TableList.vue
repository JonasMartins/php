<template>
  <div><!-- Must have only one div  -->
    <div class="inline">
      <a v-if="create && !modal" v-bind:href="create">New</a>  
      <modal-link v-if="create && modal" type="button" name="add" title="Create"></modal-link>
      <div class="form-group pull-right">
        <input type="search" class="form-control" placeholder="Search" v-model="search">
      </div>
    </div>  

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th style="cursor:pointer" v-on:click="orderColumn(index)" v-bind:key="title,index" v-for="(title,index) in titles">{{title}}</th>
          <th v-if="show || edit || destroy"></th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item,index) in list" :key="item.id">
          <td v-for="i in item" :key="i">{{i}}</td>
          <td  v-if="show || edit || destroy">
            <form v-bind:id="index" v-if="destroy && token" v-bind:action="destroy" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">

              <a v-if="show && !modal" v-bind:href="show">Show</a>
              <modal-link v-if="show && modal" v-bind:item="item" v-bind:url="show" type="link" name="show" title="Details"></modal-link>

              <a v-if="edit && !modal" v-bind:href="edit">Edit | </a>
              
              <modal-link v-if="edit && modal" v-bind:item="item" v-bind:url="edit" type="link" name="edit" title="Edit "></modal-link>
              
              <a href="#" v-on:click="runForm(index)"> Delete</a>
            </form>
            <span v-if="!token">

              <a v-if="show && !modal" v-bind:href="show">Show</a>
              <modal-link v-if="show && modal" v-bind:item="item" v-bind:url="show" type="link" name="show" title="Details"></modal-link>

              <a v-if="edit && !modal" v-bind:href="edit">Edit | </a>
              <modal-link v-if="edit && modal" v-bind:item="item" v-bind:url="edit" type="link" name="edit" title="Edit"></modal-link>
              
              <a v-if="destroy" v-bind:href="destroy"> Delete</a>  
            </span>
            <span v-if="token && !destroy">

              <a v-if="show && !modal" v-bind:href="show">Show</a>
              <modal-link v-if="show && modal" v-bind:item="item" v-bind:url="show" type="link" name="show" title="Details"></modal-link>

              <a v-if="edit && !modal" v-bind:href="edit">Edit | </a>
              <modal-link v-if="edit && modal" v-bind:item="item" v-bind:url="edit" type="link" name="edit" title="Edit"></modal-link>
            </span>
          </td>
        </tr>        
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
   props:['titles','items','create','show','edit','destroy','token','order','colorder','modal'],
   data: function(){ 
      return {
        search:'',
        orderAux: this.order || "asc",
        colorderAux: this.colorder || 0
      }
   },
   methods:{
    runForm: function(index){
      document.getElementById(index).submit();
      },
      orderColumn: function(col){
        this.colorderAux = col;
        if(this.orderAux.toLowerCase()=='asc')
          this.orderAux = 'desc';
        else
          this.orderAux = 'asc';
      }
    },
    computed:{

      list:function(){


        let order = this.orderAux;
        let colorder = this.colorderAux;

        order = order.toLowerCase();
        colorder = parseInt(colorder);

        if(order=='asc'){
          this.items.sort(function(a,b){
          if(Object.values(a)[colorder] > Object.values(b)[colorder])
            return 1;
          if(Object.values(a)[colorder] < Object.values(b)[colorder])
            return -1;
          return 0;
          });
        } else {
          this.items.sort(function(a,b){
          if(Object.values(a)[colorder] < Object.values(b)[colorder])
            return 1;
          if(Object.values(a)[colorder] > Object.values(b)[colorder])
            return -1;
          return 0;
          });  
        }

        if(this.search){
          return this.items.filter(res => {
          res = Object.values(res)
          for(let k = 0;k<res.length;k++){
            // concatenate with "" to convert a int into a string for sure
            if((res[k]+"").toLowerCase().indexOf(this.search.toLowerCase()) >= 0)
              return true;
            }
            return false;
          });
        }
        return this.items;
      }
    }
   }
</script>
