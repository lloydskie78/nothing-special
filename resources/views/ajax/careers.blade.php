

@isset($def_careers)
    @foreach($def_careers as $career)
        <div class='careers'>
            <h4 class='carttitle'>{{$career->jobTitle}}</h4>
            {!!$career->desc!!}
            @csrf
        </div>
    @endforeach
@endisset

