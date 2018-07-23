@extends('layouts.app')

@section('content')
<page size="10">
  <panel title="Articles">
    <table-list 
    v-bind:titles="['#','Title','Description']"
    v-bind:items="[ [1,'php','test description'],[2,'ruby','test description'] ] "
    create="#create"
    show="#show"
    edit="#edit"
    destroy="#destroy"
    token="#0192091082108210921">
    
    </table-list>
  </panel>
</page>
@endsection
