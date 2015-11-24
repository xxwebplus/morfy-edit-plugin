# Morfy Edit Plugin

**Instructions:**

- Paste edit folder in plugins folder
- Activate plugin on config/system.yml

		plugins
			edit

- Go to plugins/edit/edit.yml and edit this:

	# for login
	email: 'demo@gallery.com'
	password: 'demo'
	# secret Token 
	token: '324097cfa96df3036b310d9ffc9ca78f'

	# language 
	errorPassword: 'Invalid email or password'
	edit_modal_title: 'Edit Page'
	access_modal_title: 'Enter Edit Area'
	edit_btn_name: 'Edit'
	close_btn_name: 'Close'
	logout_btn_name: 'Logout'
	update_btn_name: 'Update'
	enter_btn_name: 'Emter'

- Place this code in your layout 
	
	{Action::run('Edit')}

