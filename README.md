# Morfy Edit Plugin

**Instructions:**

Paste edit folder in plugins folder
Activate plugin on config/system.yml

		plugins
			edit


Go to plugins/edit/edit.yml and edit this:


	# for login
	email: 'morfy@gmail.com'
	# password sha1(md5('demo')); for first password is demo
	password: 'a69681bcf334ae130217fea4505fd3c994f5683f'
	# secret Token sha1(md5('demo')); for first password is demo
	token: 'a69681bcf334ae130217fea4505fd3c994f5683f'


	# language 
	errorPassword: 'Invalid email or password'
	edit_modal_title: 'Edit Page'
	access_modal_title: 'Enter Edit Area'
	edit_btn_name: 'Edit'

	new_modal_title: 'New File'
	new_btn_title:  'New File'
	new_btn_name:  'Save'
	remove_btn_name:  'Remove File'
	cache_btn_name: 'Clear Cache'
	remove_alert: 'Are you sure'

	close_btn_name: 'Close'
	logout_btn_name: 'Logout'
	update_btn_name: 'Update'
	enter_btn_name: 'Emter'



Place this code in your layout 
	
	{Action::run('Edit')}

