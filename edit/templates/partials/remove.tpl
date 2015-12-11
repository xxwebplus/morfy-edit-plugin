<a class="btn btn-link" 
onclick="return confirm('{Config::get('plugins.edit.remove_alert')}')" 
href="{Url::getCurrent()}?del={$current}&token={Token::generate()}">
    {Config::get('plugins.edit.remove_btn_name')}
</a>