@switch($modal_id)
    @case('contactLink')
    {!! Form::open(['id' => "contactForm" , 'class' => 'modalForm']) !!}
    {{Form::hidden('form_id','contactForm')}}
        <div class="contactContainer modalContainer">
                {{Form::text('name',null,['placeholder' => 'name','required'])}}
                {{Form::email('email',null,['placeholder' => 'example@email.com','required'])}}
                <div>
                     {{Form::label('Message:')}}
                     {{Form::textarea('message',null,['placeholder' => 'message...','required'])}}
                </div>
                <div class="contactFooter">
                    {{Form::button('Submit', ['class' => 'btn hvr-shrink contactSubmit','type' => 'submit'])}}
                    <p>Please check your e-mail within 24 hours.</p>
                </div>
            {{--</form>--}}

        </div>
    {!! Form::close() !!}
    @break
    @case('applyLink')
    {!! Form::open(['id' => "applyForm" , 'class' => 'modalForm','files' => true]) !!}
        {{Form::hidden('form_id','applyForm')}}
        <div class="applyContainer modalContainer">
                {{Form::text('name',null,['placeholder' => 'name','required'])}}
                {{Form::email('email',null,['placeholder' => 'example@mail.com','required'])}}
                {{Form::text('contact',null,['placeholder' => '+63**********','required'])}}
                <div class="applyFooter">
                    <p><strong>Attach Resume</strong> (.doc, .docx, .odt, .txt, .pdf)</p>
                    {{Form::file('attachment',["id" => "apply_attachment",'required'])}}
                    {{Form::button('Submit', ['class' => 'btn hvr-shrink contactSubmit','type' => 'submit'])}}
                </div>
        </div>
    {!! Form::close() !!}
    @break

    @default
    Default case...
@endswitch