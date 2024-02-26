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

    //Syntax: {{POPULAR (divide by a space) the number of items (10 in default) (divide by a space) allperiod(default), today, or yesterday (divide by a space) blacklist 1|blacklist 2|(divide by "|")...}}
    //If entered just {{POPULAR}} , this will return the list with 10 items, considering whole period, without any blacklists.

    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('\{\{POPULAR[^}]*\}\}',$mode,'plugin_accscounter_popularity');
    }


    function handle($match, $state, $pos, Doku_Handler $handler){

        return explode(' ', substr($match, strlen('{{POPULAR '), -2));

    }

    function render($mode, Doku_Renderer $renderer, $data) {
        (!defined('PLUGIN_POPULAR_DEFAULT')) ? define('PLUGIN_POPULAR_DEFAULT', 10) : null;

        // Get the time zone from conf (if null, it will use the default setting on your server)
        if ($this->getConf('timezone') != '') date_default_timezone_set($this->getConf('timezone'));

        // Get current time (local)
        (!defined('CURRENT')) ? define('CURRENT', time()) : null;

        $achelper = plugin_load('helper','accscounter');

        global $INFO;
        global $conf;

        $max    = PLUGIN_POPULAR_DEFAULT;
        $except = '';

        if ($data[0] != null) $max = $data[0];

        switch (isset($data[1]) ? $data[1] : null) {
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
            $period = 'err3'; // 'Invalid period specified.
            $renderer->doc .= htmlspecialchars($this->getLang('err3'));
            return;
        }

        isset($data[2]) ? $except = '|' . $data[2] . '|' : $except = '|';

        $counters = array();

        // Get the list of all pages
        require_once(DOKU_INC.'inc/search.php');
        $dir = $conf['datadir'];
        $items = array();
        search($items, $dir, 'search_allpages', array());

        foreach ($items as $item) {
            $page = $item['id'];
            if ((strpos($except, '|' . $page . '|') !== FALSE) ||
                ! page_exists($page) || ! auth_quickaclcheck($page))
                continue;

            $array = @file($achelper->counterFN($page, '.number'));
            if ($array === FALSE) continue;
            $count = rtrim($array[0]);
            $date  = rtrim($array[1]);
            $today_count = rtrim($array[2]);
            $yesterday_count = rtrim($array[3]);

            switch ($period) {
                case 'today':
                    if (($today == $date) and ($today_count != 0)) $counters[$page] = $today_count;
                    break;
                case 'yesterday':
                    if (($yesterday == $date) and ($today_count != 0)) $counters[$page] = $today_count;
                    if (($thisday == $date) and ($yesterday_count != 0)) $counters[$page] = $yesterday_count;
                    break;
                default:
                    $counters[$page] = $count;
                    return;
            }
        }

        asort($counters, SORT_NUMERIC);

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
