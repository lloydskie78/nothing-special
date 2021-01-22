@switch($modal_id)
@case('contactLink')
{!! Form::open(['id' => 'contactForm', 'class' => 'modalForm']) !!}
{{ Form::hidden('form_id', 'contactForm') }}
<div class="contactContainer modalContainer">
    {{ Form::text('name', null, ['placeholder' => 'name', 'required']) }}
    {{ Form::email('email', null, ['placeholder' => 'example@email.com', 'required']) }}
    <div>
        {{ Form::label('Message:') }}
        {{ Form::textarea('message', null, ['placeholder' => 'message...', 'required']) }}
    </div>
    <div class="contactFooter">
        {{ Form::button('Submit', ['class' => 'btn hvr-shrink contactSubmit', 'type' => 'submit']) }}
        <p>Please check your e-mail within 24 hours.</p>
    </div>
    {{--</form>--}}

</div>
{!! Form::close() !!}
@break
@case('applyLink')
{!! Form::open(['id' => 'applyForm', 'class' => 'modalForm', 'files' => true]) !!}
{{ Form::hidden('form_id', 'applyForm') }}
<div class="applyContainer modalContainer">
    {{ Form::text('name', null, ['placeholder' => 'name', 'class' => 'form-control form-control-sm', 'required']) }}
    {{ Form::email('email', null, ['placeholder' => 'example@mail.com', 'required']) }}
    {{ Form::text('contact', null, ['placeholder' => '+63**********', 'required']) }}
    {{ Form::select('careers', $careers, null, ['class' => 'customselect', 'id' => 'selectCareer', 'onchange' => 'careerSelect()', 'required']) }}
    <select id="selectBranch" name="selectBranch" class="customselect" onchange="branchSelect()"
        aria-placeholder="Please select a Branch">
    </select>
    {{ Form::hidden('emailVal', null, ['id' => 'emailVal', 'required']) }}
    {{ Form::hidden('branchVal', null, ['id' => 'branchVal', 'required']) }}
    <br>

    <div style="width:100%; height:150px; overflow: auto; text-align:justify; padding-top:10px;">
        <b>Privacy Notice </b><br>
        <p>
            Citihardware / Decoarts Marketing, Inc. values your right to privacy. As such, we ensure that all personal
            and sensitive information you entrusted to us, through the forms fill up and the documents you submit or
            upload to our website are managed and protected at all times in accordance with Republic Act No. 10173,
            otherwise known as the Data Privacy Act.
        </p>
        <p><br>
            The information that we collect from you are only those necessary and relevant to our dealings with you.
            Said information will be kept as long as they are pertinent for the purpose for which they were collected
            and will only be process, use and store on its intended purpose and/or as we are required under the law.
            Once the purpose has been achieved or retention of which is no longer necessary, and we shall immediately
            destroy or dispose said information in a secure manner.
        </p>
        <p><br>
            By tickling the “agree” button below you are agreeing to this Privacy Notice and explicitly authorize us,
            our employees and authorized representatives to the collection, processing and storage of your personal data
            as provided herein.
        </p>
    </div>

    <div style='float:left; width:8%;  height:23px; margin:auto; padding-top:10px; padding-bottom:10px;'>
        <input type="checkbox" name="check" id="cbagree" value="1" style='width: 17px; 
                        height: 17px;' required>
    </div>

    <div style='float:right; width:92%; text-align:left; padding-top:10px; padding-bottom:10px;'>
        <label>I agree to this Privacy Notice</label>
    </div>

    <br>
    <div class="applyFooter">
        <p><strong>Attach Resume</strong> (.doc, .docx, .odt, .txt, .pdf)</p>
        {{ Form::file('attachment', ['id' => 'apply_attachment', 'required']) }}
        {{ Form::button('Submit', ['class' => 'btn hvr-shrink contactSubmit', 'type' => 'submit']) }}
    </div>
</div>
{!! Form::close() !!}
@break

@case('announcement')

<div id="imageContainer">
    <span id="linkButtons">
        <a href="https://shop.citihardware.com" target="_blank"><button id='btnShop'></button></a>
        <a href="https://www.lazada.com.ph/shop/citihardware-inc/" target="_blank"><button id='btnLazada'></button></a>
    </span>
    <img id='imgannouncement' src="{{ asset('assets/img/modal_popup/announcement.webp') }}" />
</div>
@break


@default
Default case...
@endswitch

{{-- <style>
    .customselect {
        -webkit-appearance: menulist-button;
        height: 30px;
        width: 100%;
    }
</style> --}}