<?php
/**
 * Access Counter and Popularity Plugin -- Data Manager
 * Easy way to view and manage the log
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  HokkaidoPerson <dosankomali@yahoo.co.jp>
 */


// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'admin.php');

/**
 * All DokuWiki plugins to extend the admin function
 * need to inherit from this class
 */
class admin_plugin_accscounter extends DokuWiki_Admin_Plugin {

    /**
     * access for managers
     */
    function forAdminOnly(){
        return false;
    }

    /**
     * return sort order for position in admin menu
     */
    function getMenuSort() {
        return 100;
    }

    /**
     * handle user request
     */
    function handle() {
    }

    /**
     * output appropriate html
     */
    function html() {
        global $lang;
        global $conf;
        $achelper = plugin_load('helper','accscounter');

        echo $this->locale_xhtml('heading');

        if ($_REQUEST['function'] == 'sfscheck' and !plugin_isdisabled('stopforumspam2')) {
            if ($helper = plugin_load('helper','stopforumspam2')) {
                foreach ($_REQUEST['select'] as $page) {
                    if (file_exists($achelper->counterFN($page, '.ip'))) {
                        $ipdata = @file($achelper->counterFN($page, '.ip'));
                        if ($ipdata != FALSE) {
                            $newcontents = array();
                            foreach ($ipdata as $dataline) {
                                $element = explode('|', $dataline);
                                $element[0] = trim($element[0]);
                                $element[1] = trim($element[1]);
                                if ($helper->quickipcheck($element[0], $this->getConf('sfsExFreq'), $this->getConf('sfsExConf'))) {
                                    $counterarray = @file($achelper->counterFN($page, '.number'), FILE_IGNORE_NEW_LINES);
                                    $counterarray[0] = $counterarray[0] - $element[1];
                                    $counterarray[2] = $counterarray[2] - $element[1];
                                    if ($counterarray[0] < 0) $counterarray[0] = 0;
                                    if ($counterarray[2] < 0) $counterarray[2] = 0;
                                    $writing = '';
                                    foreach ($counterarray as $part) {
                                        $writing .= $part . "\n";
                                    }
                                    io_saveFile($achelper->counterFN($page, '.number'), $writing);
                                    msg(sprintf($this->getLang('sfstried'), $page, $element[0], $element[1]));
                                } else $newcontents[] = $element[0] . '|' . $element[1];
                            }
                            $writing = '';
                            foreach ($newcontents as $part) {
                                $writing .= $part . "\n";
                            }
                            io_saveFile($achelper->counterFN($page, '.ip'), $writing);
                            msg($this->getLang('sfsfinish'), 1);
                        }
                    }
                }
            }
        }

        if ($_REQUEST['function'] == 'delete') {
            foreach ($_REQUEST['select'] as $page) {
                if (file_exists($achelper->counterFN($page, '.number')) and @unlink($achelper->counterFN($page, '.number')) == FALSE) msg(sprintf($this->getLang('mngfaileddel'), $page), -1);
                if (file_exists($achelper->counterFN($page, '.ip')) and @unlink($achelper->counterFN($page, '.ip')) == FALSE) msg(sprintf($this->getLang('mngfaileddel'), $page), -1);
            }
            msg($this->getLang('mngdelfinish'), 1);
        }

        if ($_REQUEST['action'] == 'mng'){
            $found = array();
            $metadir = $this->getFiles($conf['metadir'] . '/_accscounter');
            $length = utf8_strlen($conf['metadir'] . '/_accscounter/');
            foreach ($metadir as $filename) {
                $islogfile = utf8_substr($filename, $length);
                $islogfile = utf8_decodeFN($islogfile);
                $islogfile = str_replace('/', ':', $islogfile);
                if (utf8_substr($islogfile, mb_strrpos($islogfile, '.') + 1) != 'number') continue;
                $page = utf8_substr($islogfile, 0, utf8_strlen($islogfile) - utf8_strlen('.number'));
                $specified = FALSE;
                if ($_REQUEST['mode'] == 'existing' and page_exists($page)) $specified = TRUE;
                if ($_REQUEST['mode'] == 'deleted' and !page_exists($page)) $specified = TRUE;
                if ($_REQUEST['mode'] == 'all') $specified = TRUE;
                if ($_REQUEST['mode'] == 'search' and strpos($page, cleanID($_REQUEST['keyword'])) !== FALSE) $specified = TRUE;
                if ($specified) $found[$page] = $filename;
            }

            if ($found == array()) {
                echo $this->locale_xhtml('noitem');
                echo $this->locale_xhtml('mngintro');
                echo '<form method="get" action="">';
                echo '<input type="hidden" name="do" value="admin">';
                echo '<input type="hidden" name="page" value="accscounter">';
                echo '<input type="hidden" name="action" value="mng">';
                echo '<input type="hidden" name="mode" value="search">';
                echo '<input type="text" name="keyword" size="40"> ';
                echo '<input type="submit" value="' . $lang['btn_search'] . '"class="button" />';
                echo '</form>';
                return;
            }
            echo $this->locale_xhtml('viewer');
            echo '<form name="form" method="post" action="">';
            echo '<table class="table">';
            echo '<tr><th><label><input type="checkbox" name="all" onClick="AllChecked();" />' . $this->getLang('selectall') . '</label></th><th>' . $this->getLang('pagename') . '</th><th>' . $this->getLang('sofar') . '</th><th>' . $this->getLang('lastdate') . '</th><th>' . $this->getLang('today') . '</th><th>' . $this->getLang('yest') . '</th><th>' . $this->getLang('ipadd') . '</th></tr>';
            foreach ($found as $page => $filename) {
                $array = @file($filename);
                if ($array === FALSE) continue;
                echo '<tr><td><input type="checkbox" name="select[]" value="' . $page . '" onClick="DisChecked();" /></td>';
                echo '<td>' . p_render('xhtml', p_get_instructions('[[:' . $page . ']]'), $info) . '</td>';
                echo '<td>' . $array[0] . '</td>';
                echo '<td>' . $array[1] . '</td>';
                echo '<td>' . $array[2] . '</td>';
                echo '<td>' . $array[3] . '</td>';
                echo '<td>' . $array[4] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<select name="function">';
            echo '<option value="none" selected>' . $this->getLang('pleasechoose') . '</option>';
            echo '<option value="sfscheck">' . $this->getLang('sfscheck') . '</option>';
            echo '<option value="delete">' . $this->getLang('delete') . '</option>';
            echo '</select><br><input type="submit" value="' . $this->getLang('run') . '"class="button" />';
            echo '</form>';
            echo <<<EOT
<script language="JavaScript" type="text/javascript">
<!--
  function AllChecked(){
    var all = document.form.all.checked;
    for (var i=0; i<document.form.elements['select[]'].length; i++){
      document.form.elements['select[]'][i].checked = all;
    }
  }

  function　DisChecked(){
    var checks = document.form.elements['select[]'];
    var checksCount = 0;
    for (var i=0; i<checks.length; i++){
      if(checks[i].checked == false){
        document.form.all.checked = false;
      }else{
        checksCount += 1;
        if(checksCount == checks.length){
          document.form.all.checked = true;
        }
      }
    }
  }
// -->
</script>
EOT;
            return;
        }

        echo $this->locale_xhtml('mngintro');
        echo '<form method="get" action="">';
        echo '<input type="hidden" name="do" value="admin">';
        echo '<input type="hidden" name="page" value="accscounter">';
        echo '<input type="hidden" name="action" value="mng">';
        echo '<input type="hidden" name="mode" value="search">';
        echo '<input type="text" name="keyword" size="40"> ';
        echo '<input type="submit" value="' . $lang['btn_search'] . '"class="button" />';
        echo '</form>';

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
