@extends('layouts.app')
@section('content')
    <div class="New_col-centre">

        <!--start-->
        <div class="drop">&nbsp;</div>
        <h2 class="bg_h2">{{ strtoupper($sopcast->title) }}</h2>

        <div id="ads_livetv">
            <?php echo $sopcast->content; ?>
        </div>

    </div>
@endsection