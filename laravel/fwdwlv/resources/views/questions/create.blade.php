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
                      <div class="form-group">
                          <label for="question-title">Title</label>
                          <input type="text" name="title" id="question-title" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="question-body">Question</label>
                        <textarea name="body" id="question-body" cols="30" rows="10" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Send</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
