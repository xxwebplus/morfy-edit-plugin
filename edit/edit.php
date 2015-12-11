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

            // new file
            if (Request::post('Save_page')) {
                if (Request::post('token')) {
                    $filename = Request::post('newFile');
                    $dir = Request::post('directory');
                    $content = Request::post('newContent');

                    if ($filename && $content) {
                        // empty dir save on pages dir 
                         if ($dir == '') {
                             if (File::exists(STORAGE_PATH.'/pages/'.sanitize($filename).'.md')) {
                                 die('<span class="alert alert-danger">The file '.sanitize($filename).' already exists</span>');
                             }
                             File::setContent(STORAGE_PATH.'/pages/'.$filename.'.md', $content);
                             Request::redirect(Url::getBase().'/'.$filename);
                         } else {
                             if (File::exists(STORAGE_PATH.'/pages/'.$dir.'/'.sanitize($filename).'.md')) {
                                 die('<span class="alert alert-danger">The file '.sanitize($filename).' already exists</span>');
                             }
                             File::setContent(STORAGE_PATH.'/pages/'.$dir.'/'.sanitize($filename).'.md', $content);
                             Request::redirect(Url::getBase().'/'.$dir.'/'.sanitize($filename));
                         }
                        //
                    } else {
                        die('You Cant write empty file');
                    }
                } else {
                    // crsf
                    die('crsf detect');
                }
            }

            // remove file
            if (Request::get('del')) {
                if (Request::get('token')) {
                    File::delete(STORAGE_PATH.'/pages'.Request::get('del').'.md');
                    Request::redirect(Url::getBase());
                } else {
                    die('crsf detect !');
                }
            }

            // remove Cache
            if (Request::get('clearcache') == 'true') {
                if (Request::get('token')) {
                    $cache = File::scan(CACHE_PATH.'/fenom', 'php');
                    foreach ($cache as $item) {
                        File::delete($item);
                    }
                    Request::redirect(Url::getBase());
                } else {
                    die('crsf detect !');
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
                'current' => $url,
                'directory' => Dir::scan(STORAGE_PATH.'/pages'),
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

/**
 *   Get  pretty url like hello-world.
 *
 * @param unknown $str
 *
 * @return string
 */
function sanitize($str)
{
    //Lower case everything
    $str = strtolower($str);
    //Make alphanumeric (removes all other characters)
    $str = preg_replace("/[^a-z0-9_\s-]/", '', $str);
    //Clean up multiple dashes or whitespaces
    $str = preg_replace("/[\s-]+/", ' ', $str);
    //Convert whitespaces and underscore to dash
    $str = preg_replace("/[\s_]/", '-', $str);

    return $str;
}
