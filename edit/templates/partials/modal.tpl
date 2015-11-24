<!-- Modal -->
<div class="modal fade" id="access_login" tabindex="-1" role="dialog" aria-labelledby="plugin_area_access">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-info" id="plugin_area_access">
					{Config::get('plugins.edit.access_modal_title')}
				</h4>
			</div>
			<div class="modal-body">
				<form class="form" action="" method="post">
					<input type="hidden" name="token" value="{Token::generate()}">
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control"  name="password" required>
					</div>
		  	</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					{Config::get('plugins.edit.close_btn_name')} 
				</button>
				<input type="submit" class="btn btn-primary" name="access_login" value="{Config::get('plugins.edit.enter_btn_name')} ">
			</form>
			</div>
		</div>
	</div>
</div>