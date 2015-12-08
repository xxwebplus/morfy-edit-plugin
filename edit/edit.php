<?php

/**
 * Morfy Edit Plugin.
 *
 * (c) Moncho Varela / Nakome <nakome@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
* fn: {Action::run('Edit')}
*/
Action::add('Edit', function () {

        // login vars
        $user = trim(Config::get('plugins.edit.email'));
        $password = trim(Config::get('plugins.edit.password'));
        $token = trim(Config::get('plugins.edit.token'));
        $hash = md5($token.$password);

        // get plugin info
        //var_dump(json_encode(Config::getConfig(),true));

        // current url
        $url = str_replace(Url::getBase(), '', Url::getCurrent());
        $page = '';
        $name = '';
        // empty = index.md
        if ($url == trim('/')) {
            $name = trim('/index.md');
            $page = File::getContent(STORAGE_PATH.'/pages'.$name);
            // blog = blog/index.md
        } elseif ($url == trim('/blog')) {
            $name = trim('/blog/index.md');
            $page = File::getContent(STORAGE_PATH.'/pages'.$name);
            /*
    // for another index folder names
    }else if($url == trim('/foldername ')){
        $name = trim('/foldername/index.md');
        $page = File::getContent(STORAGE_PATH.'/pages'.$name);
    */
            // others
        } else {
            $name = trim($url.'.md');
            $page = File::getContent(STORAGE_PATH.'/pages'.$name);
        }
        // template factory
        $template = Template::factory(PLUGINS_PATH.'/'.Config::get('plugins.edit.name').'/templates/');
        $template->setOptions(['strip' => false]);

        // show loginbtn
        if (Session::exists(Config::get('plugins.edit.name').'_user')) {
            // update file
            if (Request::post('Update_page')) {
                if (Request::post('token')) {
                    $content = Request::post('content');
                    if ($content) {
                        File::setContent(STORAGE_PATH.'/pages'.$name, $content);
                        Request::redirect(Url::getCurrent());
                    } else {
                        die('You Cant write empty file');
                    }
                } else {
                    // crsf
                    die('crsf detect');
                }
            }

            // logout
            if (Request::post('access_logout')) {
                Session::delete(Config::get('plugins.edit.name').'_user');
                Request::redirect(Url::getCurrent());
            }

            // show template
            $template->display(
                'admin.tpl', [
                'title' => $name,
                'content' => $page,
                ]
            );
        } else {

            // login
            if (Request::post('access_login')) {
                if (Request::post('token')) {
                    if (Request::post('password') == $password &&
                        Request::post('email') == $user) {
                        @Session::start();
                        Session::set(Config::get('plugins.edit.name').'_user', $hash);
                        // show admin template
                        Request::redirect(Url::getCurrent());
                    } else {
                        // password not correct show error
                        $template->display(
                            'partials/error.tpl', [
                            'title' => 'Access Error',
                            'content' => Config::get('plugins.gallery.errorPassword'),
                            ]
                        );
                    }
                } else {
                    // crsf
                    die('crsf detect');
                }
            }
            // show template
            $template->display('home.tpl');
        }
    });
