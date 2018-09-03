@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit link sopcast
                        <small>link sopcast</small>
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
                          action="{{ base_url('/link/update/'.$link->id_link) }}">

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="title">Tiêu đề <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="title" name="title" value="{{ $link->title }}"
                                       class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                       data-validate-words="2" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="datetime">Thời gian <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input id="datetime" name="datetime" value="{{ $link->datetime }}"
                                       class="form-control col-md-7 col-xs-12 datetime" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="content">Nội dung <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea id="content" required="required" name="content"
                                          class="form-control col-md-7 col-xs-12">
                                    {{ $link->content }}
                                </textarea>
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
    <script src="/public/backend/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

@endsection
