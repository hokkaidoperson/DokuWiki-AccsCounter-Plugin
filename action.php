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
        if($event->data != 'accscounter_datatransfer') {
            if (auth_ismanager() and file_exists(DOKU_PLUGIN . 'accscounter/log/')) msg($this->getLang('datanotice'), 2);
            return;
        }
        $event->preventDefault();
    }
 
    public function my_action(Doku_Event $event, $param) {
        if($event->data != 'accscounter_datatransfer') return;
        $event->preventDefault();
        global $conf;

        if (!auth_ismanager()) {
            echo 'Permission Denied';
            return;
        }

        if (!file_exists(DOKU_PLUGIN . 'accscounter/log/')) {
            echo $this->getLang('noneed');
            return;
        }

        if ($_GET['mode'] == 'move') {
            $old = DOKU_PLUGIN . 'accscounter/log/iplogs/';
            $new = $conf['cachedir'] . '/accscounterlog/';

            if (file_exists($old)) {
                echo $this->getLang('moveiplog') . ': ';
                if ($this->dir_copy($old, $new)) echo $this->getLang('success') . '<br>'; else echo $this->getLang('failiplog') . '<br>';
            }

            echo '<br>' . $this->getLang('movenmlog') . ':<br>';
            $aryret = array();
            $dir = DOKU_PLUGIN . 'accscounter/log/';
            $ext = '.count';
            $pattern = '/^([-_.a-zA-Z0-9%]+)' . preg_quote($ext, '/') . '$/';
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
                    if (!io_saveFile(metaFN($page, '.accscounternm'), $data)) {
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
                if (rmdir($dir)) echo '<br>' . $this->getLang('complete') . '<br>'; else echo '<br>' . $this->getLang('remaining') . '<br>';

            } else echo $this->getLang('failnmdir') . '<br>';
            echo '<br>' . $this->getLang('funcend');
            return;
        }

        if ($_GET['mode'] == 'delete') {
            if ($this->delTree(DOKU_PLUGIN . 'accscounter/log/')) echo $this->getLang('successdel') . '<br>'; else echo $this->getLang('faildel') . '<br>';
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

}


