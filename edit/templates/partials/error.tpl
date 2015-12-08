<div class="modal show" id="access_error" tabindex="-1" role="dialog" aria-labelledby="error">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-info">
                <a class="close" 
                    href="javascript:$('#access_error').remove();$('#access_login').modal('show');">
                    <span aria-hidden="true">&times;</span>
                </a>
                {$title}
            </div>
            <div class="modal-body text-danger" >
                {$content}
            </div>
        </div>
    </div>
</div>