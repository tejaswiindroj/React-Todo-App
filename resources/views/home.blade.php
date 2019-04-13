@extends('layouts.app')

@section('content')
<div class ="container">
<div class ="float-right">
   <form action ="/search" method="get">
      <input type ="search" name="search" calss ="form-control">
      <span class ="input-group-preprend">
        <button type ="submit" class="btn btn-primary">search</button>
      </span>
   </div>
   </form>
   </div>
   
<div id ="root">
</div>
<div class="container">
<div class="row justify-content-center">
<div class ="col-md-12">
<div class="card">
<div class ="card-header"><h2>All Data</h2></div>
<table class = "table table-bordered">
  <thead>
    <tr>
    <th><b>ID</b></th>
      <th><b>Name</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($tasks as $task)
    <tr>
    
      <td>{{$task->id}} </td>
      <td>{{$task->name}} </td>
      
    </tr>

    @endforeach
  </tbody>

  
  </div>
  </div>
  </div>
</div>
<script>
   $('#button').click(function() {
    $(this).val('clicked');
});
</script>
@endsection
