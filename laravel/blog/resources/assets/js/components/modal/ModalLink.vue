<template>
	<span>	
	  <!-- <button v-if="!type || (type != 'button' && type != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">
	    {{title}}
	  </button> -->
		<span v-if="item">
			<button v-on:click="fillForm()" v-if="type=='button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">
	    {{title}}
			</button>
			<a v-on:click="fillForm()" v-if="type=='link'" href="#" data-toggle="modal" v-bind:data-target="'#' + name">
				{{title}}
			</a>
		</span> 
		<span v-else>
			<button v-if="type=='button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + name">
	    	{{title}}
			</button>
			<a v-if="type=='link'" href="#" data-toggle="modal" v-bind:data-target="'#' + name">
				{{title}}
			</a>	
		</span>
	  
	</span>
</template>

<script>
  export default {
		props:['type','name','title','css','item'],
		methods:{
			fillForm:function(){
				this.$store.commit('setItem',this.item);
			}
		}
  }
</script>
