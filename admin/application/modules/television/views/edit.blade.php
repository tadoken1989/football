@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thêm lịch phát sóng
                        <small>Lịch phát</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate="" method="post"
                          action="{{ base_url('/television/updateAction/'.$link->id) }}">
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="league">Chọn giải <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="league" name="league" required>
                                    @foreach(loadLeague() as $league)
                                        @if($league->id == $link->league->id)
                                            <option value="{{ $league->id }}" selected> {{ $league->name  }}</option>
                                        @else
                                            <option value="{{ $league->id }}"> {{ $league->name  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="home_team">Chọn đội nhà <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="home_team" name="home_team" required>
                                    @foreach(loadTeam() as $team)
                                        @if($team->team_id == $link->home_team->team_id)
                                        <option value="{{ $team->team_id }}" selected> {{ $team->name  }}</option>
                                        @else
                                            <option value="{{ $team->team_id }}"> {{ $team->name  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="away_team">Chọn đội khách
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="away_team" name="away_team" required>
                                    @foreach(loadTeam() as $team)
                                        @if($team->team_id == $link->away_team->team_id)
                                            <option value="{{ $team->team_id }}" selected> {{ $team->name  }}</option>
                                        @else
                                            <option value="{{ $team->team_id }}"> {{ $team->name  }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="channel">Kênh <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="channel" name="channel" value="{{ $link->channel }}"
                                       class="form-control col-md-7 col-xs-12" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="round">Vòng <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="round" name="round" value="{{ $link->round }}"
                                       class="form-control col-md-7 col-xs-12" required="required" type="number">
                            </div>
                        </div>
                        <div class="item form-group ">
                            <label for="status" class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" required="required" id="status"
                                        name="status">
                                    @if($link->status == 1)
                                        <option value="1" selected>Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Kích hoạt</option>
                                        <option value="0" selected>Ẩn</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
