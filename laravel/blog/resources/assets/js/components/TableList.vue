<template>
  <div><!-- Must have only one div  -->
    <div class="inline">
      <a v-if="create" v-bind:href="create">New</a>      
      <div class="form-group pull-right">
        <input type="search" class="form-control" placeholder="Search" v-model="search">

      </div>
    </div>  

    <table class="table table-striped table-hover">
      <thead>
        <tr>
      
          <th v-for="title in titles">{{title}}</th>
          <th v-if="show || edit || destroy">@@@</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item,index) in list">
          <td v-for="i in item">{{i}}</td>
          <td  v-if="show || edit || destroy">
            <form v-bind:id="index" v-if="destroy && token" v-bind:action="destroy" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">
              <a v-if="show" v-bind:href="show">Show | </a>
              <a v-if="edit" v-bind:href="edit">Edit | </a>
              <a href="#" v-on:click="runForm(index)"> Delete</a>
            </form>
            <span v-if="!token">
              <a v-if="show" v-bind:href="show">Show | </a>
              <a v-if="edit" v-bind:href="edit">Edit | </a>
              <a v-if="destroy" v-bind:href="destroy"> Delete</a>  
            </span>
            <span v-if="token && !destroy">
              <a v-if="show" v-bind:href="show">Show</a> |
              <a v-if="edit" v-bind:href="edit">Edit</a> |
            </span>
          </td>
        </tr>        
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
   props:['titles','items','create','show','edit','destroy','token','order','colorder'],
   data: function(){
      return {
        search:''
      }
   },
   methods:{
    runForm: function(index){
      document.getElementById(index).submit();
      }
    },
    computed:{

      list:function(){

        let order = this.order || 'asc';
        let colorder = this.colorder || 0;

        order = order.toLowerCase();
        colorder = parseInt(colorder);

        if(order=='asc'){
          this.items.sort(function(a,b){
          if(a[colorder]>b[colorder])
            return 1;
          if(a[colorder]<b[colorder])
            return -1;
          return 0;
          });
        } else {
          this.items.sort(function(a,b){
          if(a[colorder]<b[colorder])
            return 1;
          if(a[colorder]>b[colorder])
            return -1;
          return 0;
          });  
        }

        

        return this.items.filter(res => {
          for(let k = 0;k<res.length;k++){
            // concatenate with "" to convert a int into a string for sure
            if((res[k]+"").toLowerCase().indexOf(this.search.toLowerCase()) >= 0){
              return true;
            }  
          }
          return false;
        });
        return this.items;
      }
    }
   }
</script>
