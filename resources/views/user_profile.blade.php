@extends("layout.layout")

@section("content")

<div class="container">

  <form method="POST" action="{{ URL('update_profile') }}" style="border:1px solid #ccc">
    <div class="container">
      <h1>User Info</h1>
      <hr>
      @csrf()

      <input type="hidden" name="action" value="user-update"/>
      <input  type="hidden" name="id" value="{{ $data->Id_usuario }}"/>
          <div class="form-group">
          <label for="psw-repeat"><b>Username</b></label>
          <input  class="form-control" type="text" placeholder="Enter Username" name="Username" value="{{ $data->Username }}" >
          @error("Username")
            <p class="alert alert-danger">{{$message}}</p>
          @enderror
           </div>
             <div class="form-group">
          <label for="psw"><b>Password</b></label>
          <input  class="form-control" type="text" placeholder="Enter Password" value="" name="password" >

     </div>
      <div class="form-group">
        <label for="email"><b>Name</b></label>
        <input  class="form-control" type="text" placeholder="Enter Name" value="{{ $data->Nombre }}" name="Nombre" >
        @error("Nombre")
            <p class="alert alert-danger">{{$message}}</p>
          @enderror
      </div>
       <div class="form-group">
      <label for="email"><b>Apellido1</b></label>
      <input  class="form-control" type="text" placeholder="Enter Apellido1" value="{{ $data->Apellido1 }}" name="Apellido1" >
       @error("Apellido1")
            <p class="alert alert-danger">{{$message}}</p>
          @enderror
      </div>
       <div class="form-group">

      <label for="email"><b>Apellido2</b></label>
      <input  class="form-control" type="text" placeholder="Enter Apellido2" value="{{ $data->Apellido2 }}" name="Apellido2" >
       @error("Apellido2")
            <p class="alert alert-danger">{{$message}}</p>
          @enderror
      </div>
         
       
           <div class="form-group">

      <div class="clearfix">
        <button  class="form-control btn btn-primary"  type="submit" >Update</button>
      </div>
      </div>
    </div>
  </form>
</div>


@endsection