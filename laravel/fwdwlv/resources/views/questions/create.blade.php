@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask a Question</h2>
                    </div>
                    <div class="ml-auto">
                        <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">All questions</a>
                    </div>
                </div>

                <div class="card-body">
                  <form action="{{route('questions.store')}}" method="POST">
                    @include("questions._form",['buttonAction' => 'Send'])
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
