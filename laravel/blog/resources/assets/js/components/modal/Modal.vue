<template>
  <!-- Modal -->
  <div class="modal fade" v-bind:id="name" tabindex="-1" role="dialog" v-bind:aria-labelledby="name" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" v-bind:id="name">{{title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <slot></slot>
          </div>
          <div class="modal-footer">
            <slot name="buttons"></slot>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:['name','title']
  }
</script>
