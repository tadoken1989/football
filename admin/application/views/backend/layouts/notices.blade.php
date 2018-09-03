@if(checkSessionExits('success'))
    <div class="alert alert-success fade in flash_message">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>{{ loadFlashSessionMsg('success') }}</strong>
    </div>
@endif

@if(checkSessionExits('error'))
    <div class="alert alert-danger fade in flash_message">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>{{ loadFlashSessionMsg('error') }}</strong>
    </div>
@endif