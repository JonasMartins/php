@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
   <div class="col-md-10 col-md-offset-1">
     <panel title="Dashboard">
      Test
      <div class="row">
        <div class="col-md-4">
          <panel title="content 1" color="text-white bg-dark">
           Test
         </panel>
       </div>
       <div class="col-md-4">
        <panel title="content 2" color="text-white bg-info">
         Test
       </panel>
     </div>
     <div class="col-md-4">
       <panel title="content 3" color="text-white bg-success">
         Test
       </panel>
     </div>
    </div>
    
    <div class="row">
      <div class="col-md-4">
       <box>
         
       </box>
      </div>
    </div>

 </panel>

</div>
</div>
</div>
@endsection
