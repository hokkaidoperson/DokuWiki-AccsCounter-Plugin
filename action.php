<?php
/**
 * Access Counter and Popularity Plugin -- Data Transferer
 * Transfers this plugin's data to new places (cache directory and meta directory)
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  HokkaidoPerson <dosankomali@yahoo.co.jp>
 */

if(!defined('DOKU_INC')) die();


class action_plugin_accscounter extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE',  $this, 'allow_my_action');
        $controller->register_hook('TPL_ACT_UNKNOWN', 'BEFORE',  $this, 'my_action');
    }

    public function allow_my_action(Doku_Event $event, $param) {
        global $INFO;
        if($event->data != 'accscounter_datatransfer') {
            if (auth_ismanager() and file_exists(DOKU_PLUGIN . 'accscounter/log/')) msg($this->getLang('datanotice'), 2);
            if (auth_ismanager() and file_exists(metaFN($INFO['id'], '.accscounternm'))) msg($this->getLang('datanotice2'), 2);
            return;
        }
        $event->preventDefault();
    }

    public function my_action(Doku_Event $event, $param) {
        if($event->data != 'accscounter_datatransfer') return;
        $event->preventDefault();
        global $conf;
        $achelper = plugin_load('helper','accscounter');

        if (!auth_ismanager()) {
            echo 'Permission Denied';
            return;
        }

        if ($_GET['mode'] == 'move') {
            $old = DOKU_PLUGIN . 'accscounter/log/iplogs/';
            $new = $conf['cachedir'] . '/accscounterlog/';
            $moved = FALSE;

            if (file_exists($old)) {
                $moved = TRUE;
                echo $this->getLang('moveiplog') . ': ';
                if ($this->dir_copy($old, $new)) echo $this->getLang('success') . '<br><br>'; else echo $this->getLang('failiplog') . '<br><br>';
            }

            echo $this->getLang('movenmlog') . ':<br>';
            $aryret = array();
            $dir = DOKU_PLUGIN . 'accscounter/log/';
            $ext = '.count';
            $pattern = '/^([-_.a-zA-Z0-9%]+)' . preg_quote($ext, '/') . '$/';
            $dir2 = $conf['metadir'];
            $ext2 = '.accscounternm';
            $pattern2 = '/^([-_.a-zA-Z0-9%]+)' . preg_quote($ext2, '/') . '$/';
            if (file_exists($dir)) {
                $dp = @opendir($dir);
                if ($dp) {
                    $matches = array();
                    while (($file = readdir($dp)) !== FALSE) {
                        if (preg_match($pattern, $file, $matches)) {
                            $aryret[$file] = urldecode($matches[1]);
                        }
                    }
                    closedir($dp);

                    foreach ($aryret as $file=>$page) {
                        echo $page . ' → ';
                        $data = file_get_contents($dir . $file);
                        if ($data === FALSE) {
                            echo $this->getLang('failnmload') . '<br>';
                            continue;
                        }
                        if (!io_saveFile($achelper->counterFN($page, '.number'), $data)) {
                            echo $this->getLang('failnmsave') . '<br>';
                            continue;
                        }
                        if (!unlink($dir . $file)) {
                            echo $this->getLang('failnmdel') . '<br>';
                            continue;
                        }
                        echo $this->getLang('success') . '<br>';
                    }
                    unlink($dir . '.htaccess');
                    if (rmdir($dir)) echo '<br>' . $this->getLang('complete') . '<br><br>'; else echo '<br>' . $this->getLang('remaining') . '<br><br>';

                } else echo $this->getLang('failnmdir') . '<br><br>';
            }

            $metadir = $this->getFiles($conf['metadir']);
            $length = utf8_strlen($conf['metadir'] . '/');
            foreach ($metadir as $filename) {
                $islogfile = utf8_substr($filename, $length);
                $islogfile = utf8_decodeFN($islogfile);
                $islogfile = str_replace('/', ':', $islogfile);
                if (utf8_substr($islogfile, mb_strrpos($islogfile, '.') + 1) != 'accscounternm') continue;
                $moved = TRUE;
                $page = utf8_substr($islogfile, 0, utf8_strlen($islogfile) - utf8_strlen('.accscounternm'));
                echo $page . ' → ';
                $data = file_get_contents($filename);
                if ($data === FALSE) {
                    echo $this->getLang('failnmload2') . '<br>';
                    continue;
                }
                if (!io_saveFile($achelper->counterFN($page, '.number'), $data)) {
                    echo $this->getLang('failnmsave') . '<br>';
                    continue;
                }
                if (!unlink($filename)) {
                    echo $this->getLang('failnmdel2') . '<br>';
                    continue;
                }
                echo $this->getLang('success') . '<br>';
            }
            if ($moved) echo $this->getLang('allloaded') . '<br><br>'; else echo $this->getLang('nothing') . '<br><br>';
            echo $this->getLang('funcend');
            return;
        }

        if ($_GET['mode'] == 'delete') {
            $deleted = FALSE;

            if (file_exists(DOKU_PLUGIN . 'accscounter/log/')) {
                $deleted = TRUE;
                if ($this->delTree(DOKU_PLUGIN . 'accscounter/log/')) echo $this->getLang('successdel') . '<br>'; else echo $this->getLang('faildel') . '<br>';
            }

            $metadir = $this->getFiles($conf['metadir']);
            $length = utf8_strlen($conf['metadir'] . '/');
            foreach ($metadir as $filename) {
                $islogfile = utf8_substr($filename, $length);
                $show = utf8_decodeFN($islogfile);
                if (utf8_substr($islogfile, mb_strrpos($islogfile, '.') + 1) != 'accscounternm') continue;
                $deleted = TRUE;
                echo $show . ' → ';
                if (!unlink($filename)) {
                    echo $this->getLang('faildellog') . '<br>';
                    continue;
                }
                echo $this->getLang('successdellog') . '<br>';
            }
            if ($deleted) echo $this->getLang('alldeleted') . '<br><br>'; else echo $this->getLang('nothingtodelete') . '<br><br>';

            echo '<br>' . $this->getLang('funcend');
            return;
        }

        echo $this->locale_xhtml('movedirection');
        return;
    }

    protected function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    protected function dir_copy($dir_name, $new_dir) {
        if (!is_dir($new_dir)) {
            mkdir($new_dir);
        }

        if (is_dir($dir_name)) {
            if ($dh = opendir($dir_name)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file == "." || $file == "..") {
                        continue;
                    }
                    if (is_dir($dir_name . "/" . $file)) {
                        $this->dir_copy($dir_name . "/" . $file, $new_dir . "/" . $file);
                        rmdir($dir_name . "/" . $file);
                    }
                    else {
                        copy($dir_name . "/" . $file, $new_dir . "/" . $file);
                        unlink($dir_name . "/" . $file);
                    }
                }
                closedir($dh);
                if (!rmdir($dir_name)) return false;
            }
        }
        return true;
    }

    protected function getFiles($path) {
        $result = array();

        foreach(glob($path . "/*") as $file) {
            if (is_dir($file)) {
                $result = array_merge($result, $this->getFiles($file));
            }

            $result[] = $file;
        }

        return $result;
    }

}
