<template>
 <div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li v-for="item in breadcrumbs" class="breadcrumb-item " v-bind:class="setActive">
        <a 
          v-if="item.url" 
          v-bind:href="item.url">
          {{item.title}}
        </a><span v-if="!item.url">{{item.title}}</span>
      </li>
    </ol>
  </nav> 
 </div>
 
</template>

<script>
  export default {
    props:['breadcrumbs'],
    computed:{
      setActive: function(){
        if(this.url)
          return "active";
        else
          return "test" 
      }
    }

  }
</script>
