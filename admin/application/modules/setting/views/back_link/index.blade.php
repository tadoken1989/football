@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-6">
                        <h2>
                            Link Config
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Position</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($list)
                            @foreach($list as $l)
                                <tr>
                                    <th>{{ $l->id }}</th>
                                    <td>{{ $l->name }}</td>
                                    <td>{{ $l->url }}</td>
                                    <td>{{ $l->position }}</td>
                                    <td>{{ $l->sort_by }}</td>
                                    @if($l->status == 1)
                                        <td><span id="status-{{ $l->id }}" class="label label-success pull-right"><i
                                                        class="fa fa-check"></i> active</span></td>
                                    @else
                                        <td><span id="status-{{ $l->id }}" class="label label-waring pull-right"><i
                                                        class="fa fa-check"></i> hidden</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ base_url('/setting/link-edit/'.$l->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit">
                                            </i> Edit
                                        </a>
                                        @if($l->status == 0)
                                            <a href="javascript:;" data-model="back_link" data-status="1" class="btn btn-xs btn-warning btn-active" data-id="{{ $l->id }}">
                                                <i class="fa fa-check-square-o">
                                                </i> Active
                                            </a>
                                        @else
                                            <a href="javascript:;"  data-status="0" data-model="back_link" class="btn btn-xs btn-danger btn-active" data-id="{{ $l->id }}">
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