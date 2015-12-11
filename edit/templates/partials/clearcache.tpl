<a class="btn btn-link" 
onclick="return confirm('{Config::get('plugins.edit.remove_alert')}')" 
href="{Url::getCurrent()}?clearcache=true&token={Token::generate()}">
    {Config::get('plugins.edit.cache_btn_name')}
</a>