@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit back link
                        <small>Link</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate="" method="post"
                          action="{{ base_url('/setting/link-update/'.$item->id) }}">

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Tên <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="name" name="name" value="{{ $item->name }}" class="form-control col-md-7 col-xs-12" required="required" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="url">Giá trị url <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="url" name="url" value="{{ $item->url }}" class="form-control col-md-7 col-xs-12" required="required" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="position">Vị trí <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                               <select  class="form-control" id="position" name="position">
                                    <option value="header">Header</option>
                                    <option value="wrapper">Wrapper</option>
                                    <option value="footer">Wrapper</option>
                               </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="sort_by">Sort <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" id="sort_by" name="sort_by" value="{{ $item->sort_by }}" class="form-control col-md-7 col-xs-12" required="required" >
                            </div>
                        </div>
                        <div class="item form-group ">
                            <label for="status" class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" required="required" id="status"
                                        name="status">
                                    @if($item->status == 1)
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
                                <button type="button" class="btn btn-primary">Cancel</button>
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
