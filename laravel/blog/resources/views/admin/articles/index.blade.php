@extends('layouts.app')

@section('content')
<page size="10">
  <panel title="Articles">
    <breadcrumb v-bind:breadcrumbs="{{$breadcrumbs}}"></breadcrumb>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> -->


    <table-list 
    v-bind:titles="['#','Title','Description']"
    v-bind:items="{{$articleList}}"
    create="#create"
    show="#show"
    edit="#edit"
    order="asc"
    colorder="2"
    destroy="#destroy"
    token="#0192091082108210921"
    modal="yes">
    
    </table-list>
  </panel>
</page>
<modal name="add">
  <panel title="Articles">
    <form-input css="" method="post" enctype="" token="">
      <div class="form-group">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" class="form-control" placeholder="Title">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" name="description" class="form-control" placeholder="Description">
      </div>
      <button class="btn btn-info">Add</button>
    </form-input>
    <!-- <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form> -->
  </panel>
</modal>

<modal name="edit">
  <panel title="Articles">
    <form-input css="" method="post" enctype="" token="">
      <div class="form-group">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" 
        v-model="$store.state.item.title"
        class="form-control"
        placeholder="Title">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" name="description"
         v-model="$store.state.item.description" 
        class="form-control" placeholder="Description">
      </div>
      <button class="btn btn-info">Add</button>
    </form-input>
  </panel>
</modal>


<modal name="details">
  <panel title="Articles">
    <form-input css="" method="post" enctype="" token="">
      <div class="form-group">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" class="form-control" 
        placeholder="Title">
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" name="description" class="form-control" 
        placeholder="Description">
      </div>
      <button class="btn btn-info">Add</button>
    </form-input>
  </panel>
</modal>

@endsection
