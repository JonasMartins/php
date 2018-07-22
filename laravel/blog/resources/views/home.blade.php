@extends('layouts.app')

@section('content')
<page size="10">
  <panel title="Dashboard">
  Test
  <div class="row">
    <div class="col-md-4">
      <box amount="166" title="Articles" url="#" color="red" icon="ion ion-pie-graph"></box>
    </div>
    <div class="col-md-4">
      <box amount="50" title="Authors" url="#" color="green" icon="ion ion-person"></box>
    </div>
    <div class="col-md-4">
      <box amount="103" title="Users" url="#" color="orange" icon="ion ion-person-stalker"></box>
    </div>
  </div>
  </panel>
</page>
@endsection
