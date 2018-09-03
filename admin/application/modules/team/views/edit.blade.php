@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit team
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

                    <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" action="{{ base_url('/team/update/'.$team->team_id) }}">

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Tên <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="name" name="name" value="{{ $team->name }}"
                                       class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Stadium <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="stadium" name="stadium" value="{{ $team->stadium }}"
                                       class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Website <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="website" name="website" value="{{ $team->website }}"
                                       class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Wiki <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="wiki" name="wiki" value="{{ $team->wiki }}"
                                       class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" type="text">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Image <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="image" name="image" class="form-control col-md-7 col-xs-12" type="file">
                            </div>
                        </div>
                        <div class="item form-group ">
                            <label for="status" class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" required="required" id="status"
                                        name="status">
                                    @if($team->status == 1)
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
    <script src="/public/backend/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

@endsection
