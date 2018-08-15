@extends('layouts.app')

@section('content')
<page size="10">
  
  @if($errors->all())
    <div class="alert alert-danger alert-dismissible text-center" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="false"></span>
      </button>
      @foreach ($errors->all() as $key => $value)
        <li><strong>{{$value}}</strong></li>
      @endforeach
    </div>
  @endif
    
  <panel title="Articles">
    <breadcrumb v-bind:breadcrumbs="{{$breadcrumbs}}"></breadcrumb>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> -->


    <table-list 
    v-bind:titles="['#','Title','Description','Date']"
    v-bind:items="{{$articleList}}"
    create="#create"
    show="/admin/articles/"
    edit="/admin/articles/"
    order="asc"
    colorder="2"
    destroy="#destroy"
    token="#0192091082108210921"
    modal="yes">
    
    </table-list>
  </panel>
</page>
<modal name="add" title="Add">
  <form-input id="form-add" action="{{route('articles.store')}}" css="" method="post" enctype="" token="{{csrf_token()}}">
    <div class="form-group">
      <label for="title">Title</label>
      <input id="title" type="text" name="title" class="form-control" placeholder="Title" value="{{old('title')}}">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input id="description" type="text" name="description" class="form-control" placeholder="Description" value="{{old('description')}}">
    </div>
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" id="content" class="form-control" cols="10" rows="10">{{old('content')}}</textarea>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input id="date" type="date" name="date" class="form-control" value="{{old('date')}}">
    </div>
  </form-input>
  <!-- Esse slot é o slot com a tag name=buttons em Modal.vue
  adicionando nesse span a tag slot com o mesmo valor de name do slot de Modal.vue
  podemos passar o conteudo a ser passado para o slot -->
  <span slot="buttons">
    <button form="form-add" class="btn btn-info">Add</button>
  </span>
</modal>

<modal name="edit" title="Edit">
  <form-input id="form-edit" v-bind:action="'/admin/articles/'+ $store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
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
    <div class="form-group">
      <label for="content">Content</label>
      <textarea name="content" id="content" class="form-control" cols="10" rows="10" v-model="$store.state.item.content"></textarea>
    </div>
    <div class="form-group">
      <label for="date">Date</label>
      <input id="date" type="date" name="date" class="form-control" v-model="$store.state.item.date">
    </div>
  </form-input>
  <span slot="buttons">
    <button form="form-edit" class="btn btn-info">Done</button>
  </span>
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
</modal>


<modal name="show" v-bind:title="$store.state.item.title">
  <p>@{{$store.state.item.description}}</p>
  <p>@{{$store.state.item.content}}</p>
</modal>

@endsection
