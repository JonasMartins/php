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
        <tr v-for="item in items">
          <td v-for="i in item">{{i}}</td>
          <td v-if="show || edit || destroy">
            <form v-if="destroy && token" action="index.html" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">

              <a v-if="show" v-bind:href="show">Show</a> |
              <a v-if="edit" v-bind:href="edit">Edit</a> |
              <a v-if="destroy" v-bind:href="destroy">Delete</a>
            </form>
            <a v-if="show" v-bind:href="show">Show</a> |
            <a v-if="edit" v-bind:href="edit">Edit</a> |
            <a v-if="destroy" v-bind:href="destroy">Delete</a>
          </td>
        </tr>        
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
   props:['titles','items','create','show','edit','destroy','token']
  }
</script>
