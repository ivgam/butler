<div id="loading-container" class="modal hide" 
     tabindex="-1" role="dialog" data-backdrop="static" 
     data-keyboard="false" 
     aria-labelledby="loading-label" aria-hidden="true">
    <div class="modal-header">
        <h3 id="loading-label">Processing</h3>
    </div>
    <div class="modal-body">
        <p>This operation can take some time...</p>
        <div class="progress progress-striped active">
            <div class="bar" style="width: 100%;"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).ajaxStart(function() {
            $('#loading-container').modal('show');
        });
        $(document).ajaxStop(function() {            
            $('#loading-container').modal('hide');
        });
    });
</script>