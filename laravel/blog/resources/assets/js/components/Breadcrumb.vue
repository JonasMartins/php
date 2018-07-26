<template>
 <div>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Library</li>
    </ol>
  </nav>  
 
 </div>
 
</template>

<script>
  export default {
    props:['breadcrumbs'],
    mounted:function(){
      console.log(this.breadcrumbs);
    }

  }
</script>
