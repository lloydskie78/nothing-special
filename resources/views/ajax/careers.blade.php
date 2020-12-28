@isset($def_careers)
    @foreach($def_careers as $career)
        <div class='careers'> 
			<h4 class='carttitle'>{{$career->jobTitle}}</h4>  
                @if($career->catID === 3) 

                    <div style = 'padding-bottom:5px;'>
                        @if($career->luzon)
                            <b>Luzon: {{$career->luzon}}</b><br>
                        @endif

                        @if($career->visayas)
                            <b>Visayas: {{$career->visayas}}</b><br>
                        @endif
                        
                        @if($career->mindanao)
                            <b>Mindanao: {{$career->mindanao}}</b><br>
                        @endif
                    </div>
                
                @endif
            <ul class="careers__qual">
            {!!nl2br($career->desc)!!}
            @csrf
            </ul>
        </div>
    @endforeach
@endisset