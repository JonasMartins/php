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
    
  <panel title="Users">
    <breadcrumb v-bind:breadcrumbs="{{$breadcrumbs}}"></breadcrumb>

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button> -->


    <table-list 
    v-bind:titles="['#','Name','Email']"
    v-bind:items="{{json_encode($modelList)}}"
    create="#create"
    show="/admin/users/"
    edit="/admin/users/"
    order="asc"
    colorder="2"
    destroy="/admin/users/"
    token="{{csrf_token()}}"
    modal="yes">
    
    </table-list>
    <div aling="center">
      {{$modelList->links()}}
    </div>
  </panel>
</page>
<modal name="add" title="Add">
  <form-input id="form-add" action="{{route('users.store')}}" css="" method="post" enctype="" token="{{csrf_token()}}">
    <div class="form-group">
      <label for="name">Name</label>
      <input id="name" type="text" name="name" class="form-control" placeholder="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="text" name="email" class="form-control" placeholder="email@example.com" value="{{old('email')}}">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" class="form-control" value="{{old('password')}}">
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
  <form-input id="form-edit" v-bind:action="'/admin/users/'+ $store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
    <div class="form-group">
      <label for="name">Name</label>
      <input id="name" type="text" name="name" 
      v-model="$store.state.item.name"
      class="form-control"
      placeholder="name">
    </div>  
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="text" name="email"
        v-model="$store.state.item.email" 
      class="form-control" placeholder="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" class="form-control">
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


<modal name="show" v-bind:title="$store.state.item.name">
  <p>@{{$store.state.item.email}}</p>
</modal>

@endsection
