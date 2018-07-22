<template>
  <div><!-- Must have only one div  -->
    <a href="#">Create</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
      
          <th v-for="title in titles">{{title}}</th>
          <th>!</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="item in items">
          <td v-for="i in item">{{i}}</td>
          <td>
            <a href="#">Edit</a> |
            <a href="#">Delete</a>
          </td>
        </tr>        
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
   props:['titles','items']
  }
</script>
