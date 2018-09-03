@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-6">
                        <h2>
                            Config system
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
                            <th>Key</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($list)
                            @foreach($list as $l)
                                <tr>
                                    <th>{{ $l->id }}</th>
                                    <td>{{ $l->name }}</td>
                                    <td>{{ $l->value }}</td>
                                    <td>
                                        <a href="{{ base_url('/setting/edit/'.$l->id) }}" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit">
                                            </i> Edit
                                        </a>
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