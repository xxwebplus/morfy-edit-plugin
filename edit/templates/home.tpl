{extends 'partials/layout.tpl'}
{block 'container'}
	<a href="javascript:void(0)" class="" data-toggle="modal" data-target="#access_login">
		{Config::get('plugins.edit.edit_btn_name')}
	</a>
	{include 'partials/modal.tpl'}
{/block}







