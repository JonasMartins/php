<template>
	<form v-bind:class="css" v-bind:action="action" v-bind:method="setMethod" v-bind:enctype="enctype">
		<input v-if="changeMethod" type="hidden" name="_method" v-bind:value="changeMethod">
		<input v-if="token" type="hidden" name="_token" v-bind:value="token">
		<slot></slot>
	</form>
</template>

<script>
	export default {
		props:['css','action','method','enctype','token'],
		data: function(){
			return {
				changeMethod:""
			}
		},
		computed: {
			setMethod: function(){
				if(this.method.toLowerCase()=='post' || this.method.toLowerCase()=='get')
					return this.method.toLowerCase();
				if(this.method.toLowerCase()=='put')
					this.changeMethod = 'put'
				if(this.method.toLowerCase()=='delete')
					this.changeMethod = 'delete'
				return 'post';	
			}
		}

	}
</script> 