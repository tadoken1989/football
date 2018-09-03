@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit config
                        <small>config</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate="" method="post"
                          action="{{ base_url('/setting/update/'.$item->id) }}">

                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="value">Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" id="value" name="name" readonly value="{{ $item->name }}" class="form-control col-md-7 col-xs-12" required="required" >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="value">Giá trị <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea id="value" name="value" class="form-control col-md-7 col-xs-12" required="required" >{{ $item->value }}</textarea>
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
