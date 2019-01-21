

@isset($def_careers)
    @foreach($def_careers as $career)
        <div class='careers'>
            <h4 class='carttitle'>{{$career->jobTitle}}</h4>
            <div class="careers__qual">
            {!!nl2br($career->desc)!!}
            @csrf
            </div>
        </div>
    @endforeach
@endisset

