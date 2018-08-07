<template>
	<span>	
	  <!-- <button v-if="!type || (type != 'button' && type != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">
	    {{title}}
	  </button> -->
	  <button v-if="type=='button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">
	    {{title}}
	  </button>
	  <a v-if="type=='link'" href="#" data-toggle="modal" v-bind:data-target="'#' + name">
	  	{{title}}
	  </a>
	</span>
</template>

<script>
  export default {
  	props:['type','name','title','css']
  }
</script>
