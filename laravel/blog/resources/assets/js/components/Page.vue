<template>
<div class="container">
  <div class="row justify-content-center">
   <div v-bind:class="defineSize">
      <slot></slot>
   </div>
  </div>
</div>
</template>

<script>
  export default {
    props:['size'],
    data:{
      pattern: 'col-md-10 col-md-offset-1'
    },
    computed:{
      
      defineSize: function(){
        if(this.size>=12){
          this.pattern = 'col-md-12';
        }
        if(this.size<2){
          this.pattern = 'col-md-2 col-md-offset-5';
        }
        if((this.size % 2)==0){
          this.pattern = 'col-md-'+this.size+' col-md-offset-'+((12-this.size)/2);
        }
        else{
          this.pattern = 'col-md-'+(parseInt(this.size)+1)+' col-md-offset-'+((12-(parseInt(this.size)+1))/2);
        }
        return this.pattern;
      }
    }
  }
</script>
