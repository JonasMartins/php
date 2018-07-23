<template>
  <div><!-- Must have only one div  -->
    <a v-if="create" v-bind:href="create">New</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
      
          <th v-for="title in titles">{{title}}</th>
          <th v-if="show || edit || destroy">@@@</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item,index) in items">
          <td v-for="i in item">{{i}}</td>
          <td v-bind:id="index" v-if="show || edit || destroy">
            <form v-if="destroy && token" v-bind:action="deletar" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">
              <a v-if="show" v-bind:href="show">Show</a> |
              <a v-if="edit" v-bind:href="edit">Edit</a> |
              <a href="#" v-on:click="runForm(index)"></a>
            </form>
            <span v-if="token">
              <a v-if="show" v-bind:href="show">Show</a> |
              <a v-if="edit" v-bind:href="edit">Edit</a> |
              <a v-if="destroy" v-bind:href="destroy">Delete</a>  
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
   props:['titles','items','create','show','edit','destroy','token'],
   methods:{
    runForm: function(index){
      document.getElementById(index).submit();
    }
   }
    
  }
</script>
