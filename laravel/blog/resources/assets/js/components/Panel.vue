<template>
  <div v-bind:class="defineColor">
    <div class="card-header">{{title}}</div>

    <div class="card-body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
   export default {
    props:['title','color'],
    computed: {
      defineColor: function(){
        return "card "+ (this.color || "bg-light");
      }
    }
  }
</script>

<style media="screen">
.bg-dark {
  background-color: #050505 !important; 
}
.card-header:first-child {
  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}

</style>
