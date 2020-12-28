<body>
<div class="container">
  <div class="panel panel-primary">
        <div class="panel-heading">
          max file size: 1mb <br>
          required dimension: width = 470px height = 702px <br>
        </div>
        <div class="panel-body" id = 'pnlbody'>
          <img id = 'imgmap' src="{{asset('assets/img/map.png')}}?={{filemtime('assets/img/map.png')}}" width = '300' height = '400'>
          
        </div>
    <br>
    <br>
    <div>
        {{Form::open(['method'=>'POST','class' => 'modal_form','id' => 'map_form','files' => true])}}
            {{Form::hidden('form_id','map_replacemap')}}
            <div>
              <div style = 'float:right; width:50%;'>
                {{Form::file('imageFile',null,['class' => 'form-control-file form_image','accept'=>'image/*','required'])}}
              </div>
              <div style = 'float:left; width:50%;'>
                {{Form::button('Upload',['type' => 'submit','class'=>'btn btn-primary'])}}
                {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
              </div>
            </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
<style>
  .modal-dialog { 
      width: 400px; 
  }
</style>