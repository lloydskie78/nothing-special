@extends('layouts.master')
@section('bg-img', asset('assets/img/banner/Branches.jpg'))
@section('content')
    <div class="brnchcontent col-10 pageContent">
        <h1 class="header-text mb-0">Our Branches</h1>
        <p class="text">CitiHardware's {{ $totalbranches }} stores are strategically located throughout the Philippines'
            major regions of Luzon, Visayas, and Mindanao and is expected to continuously grow in the coming years.</p>
        <div class="brnchbody">
            <div class="brnchlist places">
                <ul class="b_luz">
                    <li>Luzon</li>
                    @foreach ($luz as $l_branch)
                        <li><a class='indiv_branch hvr-grow'
                                href='{{ route('branch', ['id' => $l_branch->idBranch]) }}'>{{ $l_branch->branchName }}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="b_vis">
                    <li>Visayas</li>
                    @foreach ($vis as $v_branch)
                        <li><a class='indiv_branch hvr-grow'
                                href='{{ route('branch', ['id' => $v_branch->idBranch]) }}'>{{ $v_branch->branchName }}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="b_min">
                    <li>Mindanao</li>
                    @foreach ($min as $m_branch)
                        <li><a class='indiv_branch hvr-grow'
                                href='{{ route('branch', ['id' => $m_branch->idBranch]) }}'>{{ $m_branch->branchName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="brnchmap">
                <map name="phpMap">
                    @foreach ($branches as $branch)
                        <area class='tooltip' target='_blank' alt='{{ $branch->branchName }}'
                            title='{{ $branch->branchName }}' href='{{ route('branch', ['id' => $branch->idBranch]) }}'
                            shape='circle'>
                    @endforeach
                </map>
                <img src="{{ asset('assets/img/map.png') }}?={{ time() }}" usemap="#phpMap">
            </div>

            <h1 class="header-text mb-0">Contact Us</h1>
            <div class="brnchbody">
                <div class="contactForm" style="margin-top: 0px">
                    <form id="contactForm" class="modalForm">
                        <label for="fname">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Your name.." required>
                        <input name="form_id" type="hidden" value="contactForm" id="formHid">
                        <label for="lname">Email</label>
                        <input type="text" id="email" name="email" placeholder="example@email.com" required>
                        <label for="subject">Message</label>
                        <textarea id="message" name="message" placeholder="Message.." style="height:200px"
                            required></textarea>
                        <input type="submit" value="Submit" class="btn hvr-shrink contactSubmit" id="forEmail">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
