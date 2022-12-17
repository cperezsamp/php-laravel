<x-layout.header> 

 <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<style type="text/css">
  table tbody tr:hover {
    text-decoration: underline;
    color:blue;
  }
</style>
<script type="text/javascript">
  function showBig(path)
  {
    window.open(path, '_blank').focus();
  }

  function changeOrder(id)
  {
    let order = $("#order_value_"+id).val();
    let token  = $("input[name=_token]").val();
    $.ajax({
      url: "{{ URL('updateOrder')}}",
      type: "POST",
      data: {_token :token,id:id,order:order },
      dataType: "html"
    }).done(function(msg) {
      window.location.href =window.location.href;
    });
  }
</script>

<div class="container">


   @if(!empty(session("error")))
      <div class="row">
      <ul>
        @foreach(session("error") as $err)
          <li class="alert alert-danger">{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row">
  <form method="POST" action="{{ URL('event_file') }}"  enctype="multipart/form-data" style="border:1px solid #ccc;width: 100%;">
    <div class="container">
      <h1>Files Uploading</h1>
      <hr>
      @csrf()

      <div class="form-group">
        <label for="psw-repeat"><b>Select Event</b></label>
        <select name="event_id">
            @foreach($events as $row)
              <option value="{{ $row->Id_acto  }}">{{$row->Titulo}}</option>
            @endforeach
        </select>
     </div>
      <div class="form-group">
        <input  required class="form-control" type="file" multiple name="files[]" >
      </div>
         
    <div class="form-group">

      <div class="clearfix">
        <button  class="form-control btn btn-primary"  type="submit" >Submit</button>
      </div>
      </div>
    </div>
  </form>
</div>

<h1>Events Files List</h1>
<div class="row">
    <table class="table">
    <thead>
      <tr>
        <th>Event Name</th>
        <th>File</th>
        <th>Order</th>

      </tr>
    </thead>
    <tbody>
      @foreach($files as $file)
        <tr >
          <td onclick="showBig('{{ ASSET('uploading/'.$file->Localizacion_documentacion) }}')" style="cursor:pointer  ; ">{{ $file->title }}</td>
          <td onclick="showBig('{{ ASSET('uploading/'.$file->Localizacion_documentacion) }}')" style="cursor:pointer  ; ">
            <embed width="100px"  height="100px" src="{{ ASSET('uploading/'.$file->Localizacion_documentacion) }}" />
          </td>
          <td>
            <input style="display: inline-block;width: 200px" class="form-control" name="order" id="order_value_{{$file->Id_presentacion }}" value="{{ $file->Orden }}" />
            <button style="display: inline-block;" class="btn btn-primary" onclick="changeOrder({{$file->Id_presentacion }})">Update Order</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>

</x-layout.header> 
<x-layout.footer></x-layout.footer>