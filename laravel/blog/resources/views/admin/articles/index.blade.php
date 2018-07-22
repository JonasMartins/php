@extends('layouts.app')

@section('content')
<page size="10">
  <panel title="Articles">
    <a href="#">Create</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
      
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Author</th>
          <th>Date</th>
          <th>!</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
          <td>
            <a href="#">Edit</a> |
            <a href="#">Delete</a>
          </td>
        </tr>
        
      </tbody>
    </table>
  </panel>
</page>
@endsection
