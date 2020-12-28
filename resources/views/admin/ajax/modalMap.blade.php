<map name="phpMap"> 
<area class='tooltip' target='_blank' alt='{{$branch}}' title='{{$branch}}' shape='circle' data-toggle="tooltip" data-placement="right">
</map>
<div>
{{Form::open(['method'=>'POST','class' => 'modal_form','id' => 'branch_form','files' => true])}}
    {{Form::hidden('id',$id)}}
  <div style = 'float:left; width:70%; '>
    <img src="{{asset('assets/img/map.png')}}?={{filemtime('assets/img/map.png')}}" id = "imgmap" usemap="#phpMap" usemap= "#phpmap">
  </div>
  <div style = 'float:right; width:30%;  height:720px;'>
    <div>
        {{Form::label('X:')}}
        {{Form::text('tooltipx',$tooltipx,['class' => 'form-control','placeholder' => 'Tooltip X','required','onkeyup'=>'textchanged(this.value,null);','onfocus'=>'opentooltip();'])}}
    </div>
    <div>
        {{Form::label('Y:')}}
        {{Form::text('tooltipy',$tooltipy,['class' => 'form-control','placeholder' => 'Tooltip Y','required','onkeyup'=>'textchanged(null,this.value);','onfocus'=>'opentooltip();'])}}
    </div>
  </div>
  <div  >
    {{Form::hidden('form_id','branch_map')}}
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
  {!! Form::close() !!}
  </div>
</div>  
<script>

var id;
var x;
var y;

function textchanged(inputx,inputy){
  setTimeout(function(){ 
    $("area[alt='" + '{{ $branch }}' + "']").tooltipster('close');
      if(inputx){
        if (isNaN(inputx)) {
          return false;
        }
        else{
          x = inputx;
          branch_tooltip('{{ $branch }}',x,'{{$tooltipy}}');
          setTimeout(function(){ 
            $("area[alt='" + '{{ $branch }}' + "']").tooltipster('open');
          }, 1000);
        }
      }

      if(inputy){
             if (isNaN(inputy)) {
            return false;
          }
        else{
          y = inputy;
          branch_tooltip('{{ $branch }}','{{$tooltipx}}',y);

          setTimeout(function(){ 
            $("area[alt='" + '{{ $branch }}' + "']").tooltipster('open');
          }, 1000);
        }
      }
  }, 1000);
}

function opentooltip(){
  setTimeout(function(){ 
            $("area[alt='" + '{{ $branch }}' + "']").tooltipster('open');
          }, 150);
}

$(document).ready(function () {
      setTimeout(function(){ 
      branch_tooltip('{{ $branch }}','{{$tooltipx}}','{{$tooltipy}}');
      $("area[alt='" + '{{ $branch }}' + "']").tooltipster('open');
       }, 1000);
  });

$('.modal-title').text('Set Tooltip location for '+ '{{ $branch }}');

$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

function SET_XY(x,y,callback){
        $.ajax({
        url: 'setxy',
        method: 'POST',
        dataType: 'html',
        data: {
            tooltipx: x,
            tooltipy: y,
            id:id
        },
        success: function (data) {
          $('.modal-body').html(data);
          callback();
        },
        error: function () { }
    });
}

$('.tooltip').tooltipster({
        theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
        trigger: 'click',
        delay: 50,
        distance: 2
    });

function branch_tooltip(branch, top, left) {
    $("area[alt='" + branch + "']").attr('coords', "" + top + "," + left + ",5");
}

$('#imgmap').bind('click', function (ev) {
  //get the coordinates by clicking the image map
    var $div = $(ev.target);
    var $display = $div.find('.display');

    var offset = $div.offset();
    x = ev.clientX - offset.left;
    y = ev.clientY - offset.top;
    id = JSON.parse("{{ json_encode($id) }}");
    SET_XY(x,y,intializetooltip);
});

function intializetooltip(){
    branch_tooltip('{{ $branch }}',x,y);
    $("area[alt='" + '{{ $branch }}' + "']").tooltipster('open');
}

</script>

<style>
  .modal-dialog { 
      width: 680px; 
  }
</style>