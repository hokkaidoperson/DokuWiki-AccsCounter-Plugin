<?php
/**
 * Access Counter and Popularity Plugin -- Popularity Lists
 *
 * Original source of this plugin is PukiWiki.
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  HokkaidoPerson <dosankomali@yahoo.co.jp>
 */

// Original Licenses of this plugin:
//
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: popular.inc.php,v 1.20 2011/01/25 15:01:01 henoheno Exp $
// Copyright (C)
//   2003-2005, 2007 PukiWiki Developers Team
//   2002 Kazunori Mizushima <kazunori@uc.netyou.jp>
// License: WHERE IS THE RECORD?
//
// Popular pages plugin: Show an access ranking of this wiki
// -- like recent plugin, using counter plugin's count --

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class syntax_plugin_accscounter_popularity extends DokuWiki_Syntax_Plugin {

    function getType(){
        return 'substition';
    }

    function getSort(){
        return 300; // after accscounter_counter
    }

        // Internal function
        // Get a page list of this wiki
        function get_existpages($dir = DATA_DIR, $ext = '.txt')
        {
            $aryret = array();
            $pattern = '/^([-_.a-zA-Z0-9%]+)' . preg_quote($ext, '/') . '$/';

            $dp = @opendir($dir);
            if (! $dp) return $dir;
            $matches = array();
            while (($file = readdir($dp)) !== FALSE) {
                if (preg_match($pattern, $file, $matches)) {
                    $aryret[$file] = urldecode($matches[1]);
                }
            }
            closedir($dp);

            return $aryret;
        }


    //Syntax: {{POPULAR (divide by a space) the number of items (10 in default) (divide by a space) allperiod(default), today, or yesterday (divide by a space) blacklist 1|blacklist 2|(divide by "|")...}}
    //If entered just {{POPULAR}} , this will return the list with 10 items, considering whole period, without any blacklists.

    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('\{\{POPULAR[^}]*\}\}',$mode,'plugin_accscounter_popularity');
    }


    function handle($match, $state, $pos, Doku_Handler $handler){

        return explode(' ', substr($match, strlen('{{POPULAR '), -2));

    }

    function render($mode, Doku_Renderer $renderer, $data) {
        define('PLUGIN_POPULAR_DEFAULT', 10);

        // Where the directory for counter files is?
        define('COUNTER_DIR', DOKU_PLUGIN . 'accscounter/log/');

        // Get the time zone from conf (if null, it will use the default setting on your server)
        if ($this->getConf('timezone') != '') date_default_timezone_set($this->getConf('timezone'));

        // Get current time (local)
        define('CURRENT', time());


        global $INFO;

        $max    = PLUGIN_POPULAR_DEFAULT;
        $except = '';

        if ($data[0] != null) $max = $data[0];

        switch ($data[1]) {
        case ''         : /*FALLTHROUGH*/
        case 'allperiod': $period = 'allperiod';
            break;
        case 'today'    : $period = 'today';
            $today = date('Y/m/d');
            break;
        case 'yesterday': $period = 'yesterday';
            $yesterday = date('Y/m/d', CURRENT - 24 * 60 * 60);
            $thisday = date('Y/m/d');
            break;
        default:
            $renderer->doc .= htmlspecialchars($this->getLang('err3'));
            return;
        }

        $except = '|' . $data[2] . '|';

        $counters = array();

        $pagedatas = $this->get_existpages(COUNTER_DIR, '.count');

        if ($pagedatas == COUNTER_DIR) {
            $renderer->doc .= htmlspecialchars($this->getLang('err4') . COUNTER_DIR);
            return;
        }

        foreach ($pagedatas as $file=>$page) {
            if ((strpos($except, '|' . $page . '|') !== FALSE) ||
                ! file_exists(wikiFN($page)))
                continue;

            $array = file(COUNTER_DIR . $file);
            $count = rtrim($array[0]);
            $date  = rtrim($array[1]);
            $today_count = rtrim($array[2]);
            $yesterday_count = rtrim($array[3]);

            if ($today) {
                if (($today == $date) and ($today_count != 0)) $counters[$page] = $today_count;
            } else if ($yesterday) {
                if (($yesterday == $date) and ($today_count != 0)) $counters[$page] = $today_count;
                if (($thisday == $date) and ($yesterday_count != 0)) $counters[$page] = $yesterday_count;
            } else {
                $counters[$page] = $count;
            }
        }

        asort($counters, SORT_NUMERIC);

        // BugTrack2/106: Only variables can be passed by reference from PHP 5.0.5
        $counters = array_reverse($counters, TRUE); // with array_splice()
        $counters = array_splice($counters, 0, $max);


        if (! empty($counters)) {
            $renderer->listu_open();

            foreach ($counters as $page=>$count) {
                $renderer->listitem_open(1);
                $renderer->listcontent_open();

                $renderer->internallink(':' . $page);
                $renderer->cdata('(' . $count . ')');

                $renderer->listcontent_close();
                $renderer->listitem_close();
            }
            $renderer->listu_close();
        } else $renderer->doc .= $this->getLang('noitems');

    }


}
