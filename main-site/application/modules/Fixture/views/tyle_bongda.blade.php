@extends('layouts.app_full')
@section('content')
    <style>
        .New_col-centre_full {
            width: 100%;
        }
    </style>
    <div class="New_col-centre_full center">
        <div class="menu_tyle">
            @foreach(add7DayInWeek() as $key => $day)
                <a href="{{ ty_le_ca_tran_trong_tuan($day,$key) }}" @if($day == $todayInWeek) class="selected" @endif >
                    {{ $day }}
                </a>&nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
        <div class="drop">&nbsp;</div>
        <div class="k_trang">&nbsp;</div>
        <div class="content">
            <iframe src="/odds-live.html"  height="900px" framespacing="0" frameborder="no" border="0" width="100%"></iframe>
        </div>
    </div>
@endsection