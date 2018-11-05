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
                    @csrf
                      <div class="form-group">
                          <label for="question-title">Title</label>
                          <input type="text" name="title" value="{{old('title')}}" id="question-title" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('title')}}</strong>
                                </div>
                            @endif
                      </div>
                      <div class="form-group">
                        <label for="question-body">Question</label>
                        <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">{{old('body')}}</textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('body')}}</strong>
                            </div>
                        @endif

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