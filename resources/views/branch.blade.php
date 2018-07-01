@extends('layouts.master')
@section('bg-img',asset('assets/img/header-sliders/branches.jpg'))
@section('content')
    <div class="indivbrnchcontent col-10">
        <h1>Our Branches</h1>
        <div class="row1">
            <aside>
                <img src="{{asset("assets/img/branch/$branch->imageFile")}}">
                <h3>{{$branch->bName}}</h3>
                <table id="branch-table" class="lh25">
                    <tbody>
                    <tr>
                        <td class="td-header">Location</td>
                        <td>:</td>
                        <td>{{$branch->address}}</td>
                    </tr>
                    <tr>
                        <td class="td-header">Tel.</td>
                        <td>:</td>
                        <td>{{$branch->telno}}</td>
                    </tr>
                    <tr>
                        <td class="td-header">Fax</td>
                        <td>:</td>
                        <td>{{$branch->faxno}}</td>
                    </tr>
                    <tr>
                        <td class="td-header">Email</td>
                        <td>:</td>
                        <td>{{$branch->email}}</td>
                    </tr>
                    <tr>
                        <td class="td-header">Store Hours</td>
                        <td>:</td>
                        <td class="white-spaced">{{$branch->storeHours}}</td>
                    </tr>
                    </tbody>
                </table>
            </aside>
            <aside>
                <div id="googlemap" data-longitude="{{$long}}" data-latitude="{{$lat}}"></div>
            </aside>
        </div>
        <div class="row2 border-top">
            <h2>Other Luzon Branches</h2>
            <div class="otherbranches">
                @foreach($branch_except as $branch)
                    <div class="otherbranch">
                        <a href="{{route('branch',['id' => $branch->idBranch])}}">
                            <img src="{{asset("assets/img/branch/$branch->imageFile")}}" alt="">
                            <p> {{$branch->bName}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        @endsection

        @push('scripts')
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPmzd7stODgAaRmFMwGU4-nkNShKFEQPY&callback=initMap"></script>
        @endpush