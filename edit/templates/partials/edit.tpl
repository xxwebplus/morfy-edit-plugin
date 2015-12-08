<a href="javascript:void(0);" class="btn btn-link pull-left" data-toggle="modal" data-target="#edit_page">
    {Config::get('plugins.edit.edit_btn_title')}  {$title}
</a>
<!-- Modal -->
<div class="modal fade" id="edit_page" tabindex="-1" role="dialog" aria-labelledby="plugin_area_access">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="plugin_area_access">
                    {Config::get('plugins.edit.edit_modal_title')} 
                    {$title}
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post">
                    <input type="hidden" name="token" value="{Token::generate()}">
                    <div class="form-group">
                        <textarea  style="min-height:400px" class="form-control"  name="content">{$content}</textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {Config::get('plugins.edit.close_btn_name')}
                </button>
                <input type="submit" class="btn btn-primary" name="Update_page" value="{Config::get('plugins.edit.update_btn_name')}">
            </form>
            </div>
        </div>
    </div>
</div>