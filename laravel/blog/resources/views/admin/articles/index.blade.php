@extends('layouts.app')

@section('content')
<page size="10">
  <panel title="Articles">
    <breadcrumb></breadcrumb>
    <table-list 
    v-bind:titles="['#','Title','Description']"
    v-bind:items="[ [1,'php','test description'],[2,'ruby','z_test description']
    ,[3,'ia','k_test description']
    ,[4,'machine learning','v_test description']
    ,[5,'deep learning','a_test description']
    ,[6,'javascript','j_test description'] ] "
    create="#create"
    show="#show"
    edit="#edit"
    order="asc"
    colorder="2"
    destroy="#destroy"
    token="#0192091082108210921">
    
    </table-list>
  </panel>
</page>
@endsection
