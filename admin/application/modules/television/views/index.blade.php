@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-6">
                        <h2>
                            Quản lý lịch phát 
                        </h2>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ base_url('/television/add') }}" class="btn btn-success btn-sm pull-right" title="Add New">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add new
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        @include('backend.layouts.filter_date')
                    </div>
                    <br>
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Giải đấu</th>
                            <th>Ngày giờ</th>
                            <th>Kênh</th>
                            <th>Status</th>
                            <th>
                                Chủ nhà
                            </th>
                            <th>
                                Đội khách
                            </th>
                            <th>
                                Vòng đấu
                            </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($link_tv)
                            @foreach($link_tv as $link)
                                <tr>
                                    <th>{{ $link->id }}</th>
                                    <td>{{ $link->league->name }}</td>
                                    <td>{{ $link->datetime }}</td>
                                    <td>{{ $link->channel }}</td>
                                    @if($link->status == 1)
                                        <td><span id="status-{{ $link->id }}" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> active</span></td>
                                    @else
                                        <td><span id="status-{{ $link->id }}" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> hidden</span></td>
                                    @endif
                                    <td>{{ $link->home_team->name }}</td>
                                    <td>{{ $link->away_team->name }}</td>
                                    <td>{{ $link->round }}</td>
                                    <td>
                                        <a href="{{ base_url('/television/edit/'.$link->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit">
                                            </i> Edit
                                        </a>
                                        @if($link->status == 0)
                                        <a href="javascript:;" data-model="television" data-status="1" class="btn btn-xs btn-warning btn-active" data-id="{{ $link->id }}">
                                            <i class="fa fa-check-square-o">
                                            </i> Active
                                        </a>
                                        @else
                                            <a href="javascript:;"  data-status="0" data-model="television" class="btn btn-xs btn-danger btn-active" data-id="{{ $link->id }}">
                                                <i class="fa fa-trash">
                                                </i> Hide
                                            </a>
                                        @endif
                                    </td>
                                
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection