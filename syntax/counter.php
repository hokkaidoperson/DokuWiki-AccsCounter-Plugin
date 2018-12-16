<?php
/**
 * Access Counter and Popularity Plugin -- Access Counter
 *
 * Original source of this plugin is PukiWiki.
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  HokkaidoPerson <dosankomali@yahoo.co.jp>
 */

// Original Licenses of this plugin:
//
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: counter.inc.php,v 1.19 2007/02/04 11:14:44 henoheno Exp $
// Copyright (C)
//   2002-2005, 2007 PukiWiki Developers Team
//   2002 Y.MASUI GPL2 http://masui.net/pukiwiki/ masui@masui.net
// License: GPL2
//
// Counter plugin (per page)

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class syntax_plugin_accscounter_counter extends DokuWiki_Syntax_Plugin {

    function getType(){
        return 'substition';
    }

    function getSort(){
        return 200;
    }


        // Internal function
        // Return a summary
        function plugin_counter_get_count($page)
        {
            global $ACT;
            global $USERINFO;
            static $counters = array();
            static $default;

            if (! isset($default))
                $default = array(
                    'total'     => 0,
                    'date'      => date('Y/m/d'),
                    'today'     => 0,
                    'yesterday' => 0,
                    'ip'        => '');

            if (! file_exists(wikiFN($page))) return $default;
            if (isset($counters[$page])) return $counters[$page];

            // Set default
            $counters[$page] = $default;
            $modify = FALSE;

            // Load and handle the exclusion list (IPs and remote hosts)
            $exlist = str_replace(array("\r\n", "\r", "\n"), "\n", $this->getConf('exclusionList'));
            $exlist = preg_quote($exlist, '/');
            $exlist = str_replace('\*', '[0-9A-Za-z.-]+', $exlist);
            $exlist = str_replace('\?', '[0-9A-Za-z.-]', $exlist);
            $exlist = str_replace('~', '[0-9]+', $exlist);
            $exlist = str_replace('\!', '[0-9]', $exlist);
            $exlist = explode("\n", $exlist);

            $remotehost = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $excluded = FALSE;
            foreach ($exlist as $checking) {
                $prefix = '/^' . $checking . '$/';
                if (preg_match($prefix, $_SERVER['REMOTE_ADDR'])) $excluded = TRUE;
                if (preg_match($prefix, $remotehost)) $excluded = TRUE;
            }

            // Check about the country
            $countries = explode(',', $this->getConf('cntrExclusion'));
            $countries = array_map('trim', $countries);
            $countries = array_unique($countries);
            $countries = array_filter($countries);

            // Get a country code related to the user
            // Ingredients to generate a DNS address
            $ingr = explode(".", $_SERVER['REMOTE_ADDR']);
            // Compose a "cc.wariate.jp" DNS address
            $dnsaddr = $ingr[3] . "." . $ingr[2] . "." . $ingr[1] . "." . $ingr[0] . ".cc.wariate.jp";

            // Investigate now
            $dnsdatas = dns_get_record($dnsaddr, DNS_TXT);
            if ($dnsdatas !== FALSE) $hiscountry = $dnsdatas[0]["txt"]; else $hiscountry = FALSE;

            // Check now
            if ($hiscountry !== FALSE) {
                $hiscountry = utf8_strtolower($hiscountry);
                foreach ($countries as $checking) {
                    $checkinglower = utf8_strtolower($checking);
                    if ($checkinglower == $hiscountry) $excluded = TRUE;
                }
            }

            // Check about IPs reverse lookup
            if ($this->getConf('reverseLookupFailed') == '1' && $remotehost == $_SERVER['REMOTE_ADDR']) {
                $rexlist = str_replace(array("\r\n", "\r", "\n"), "\n", $this->getConf('reverseLookupException'));
                $rexlist = preg_quote($rexlist, '/');
                $rexlist = str_replace('\*', '[0-9]+', $rexlist);
                $rexlist = str_replace('\?', '[0-9]', $rexlist);
                $rexlist = explode("\n", $rexlist);

                $cntrexlist = explode(',', $this->getConf('reverseLookupCntrException'));
                $cntrexlist = array_map('trim', $cntrexlist);
                $cntrexlist = array_unique($cntrexlist);
                $cntrexlist = array_filter($cntrexlist);


                $excluded = TRUE;
                foreach ($rexlist as $checking) {
                    $prefix = '/^' . $checking . '$/';
                    if (preg_match($prefix, $_SERVER['REMOTE_ADDR'])) $excluded = FALSE;
                }

                if ($hiscountry !== FALSE) {
                    foreach ($cntrexlist as $checking) {
                        $checkinglower = utf8_strtolower($checking);
                        if ($checkinglower == $hiscountry) $excluded = FALSE;
                    }
                }

            }

            // Exclude managers and superusers?
            if ($this->getConf('excludeMgAndSp') == 'mg' && auth_ismanager()) $excluded = TRUE;
            if ($this->getConf('excludeMgAndSp') == 'sp' && auth_isadmin()) $excluded = TRUE;

            // Check about a list of users and user groups
            if(auth_isMember($this->getConf('usrExclusion'), $_SERVER['REMOTE_USER'], (array) $USERINFO['grps'])) $excluded = TRUE;


            // Open
            if (!file_exists(COUNTER_DIR)) mkdir(COUNTER_DIR);
            $file = COUNTER_DIR . urlencode($page) . PLUGIN_COUNTER_SUFFIX;
            touch($file);
            $fp = @fopen($file, 'r+');
            if ($fp == FALSE) return $this->getLang('err1') . basename($file);
            set_file_buffer($fp, 0);
            flock($fp, LOCK_EX);
            rewind($fp);

            // Read
            foreach (array_keys($default) as $key) {
                // Update
                $counters[$page][$key] = rtrim(fgets($fp, 256));
                if (feof($fp)) break;
            }

            // Anothoer day?
            if ($counters[$page]['date'] != $default['date']) {
                $modify = TRUE;
                $is_yesterday = ($counters[$page]['date'] == date('Y/m/d', CURRENT - 24 * 60 * 60));
                $counters[$page]['ip']        = $_SERVER['REMOTE_ADDR'];
                $counters[$page]['date']      = $default['date'];
                $counters[$page]['yesterday'] = $is_yesterday ? $counters[$page]['today'] : 0;
                // Excluded?
                if ($excluded == FALSE) {
                    $counters[$page]['today']     = 1;
                    $counters[$page]['total']++;

                    // Save the log?
                    switch ($this->getConf('saveLog')) {
                    case 'pdate' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = DOKU_PLUGIN . 'accscounter/log/iplogs/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . utf8_strtolower(date('M-d-Y')) . '.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $_SERVER["REMOTE_ADDR"] ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;

                    case 'ppage' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = DOKU_PLUGIN . 'accscounter/log/iplogs/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . 'wholeperiod.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $_SERVER["REMOTE_ADDR"] ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;
                    }
                } else {
                    $counters[$page]['today']     = 0;
                }
            } else if ($counters[$page]['ip'] != $_SERVER['REMOTE_ADDR']) {
                // Not the same host
                if ($excluded == FALSE) {
                    $modify = TRUE;
                    $counters[$page]['ip']        = $_SERVER['REMOTE_ADDR'];
                    $counters[$page]['today']++;
                    $counters[$page]['total']++;

                    // Save the log?
                    switch ($this->getConf('saveLog')) {
                    case 'pdate' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = DOKU_PLUGIN . 'accscounter/log/iplogs/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . utf8_strtolower(date('M-d-Y')) . '.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $_SERVER["REMOTE_ADDR"] ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;

                    case 'ppage' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = DOKU_PLUGIN . 'accscounter/log/iplogs/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . 'wholeperiod.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $_SERVER["REMOTE_ADDR"] ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;
                    }
                }
            }

            // Modify
            if ($ACT == '' or $ACT == 'show') $showing = TRUE;

            if ($modify && $showing == TRUE) {
                rewind($fp);
                ftruncate($fp, 0);
                foreach (array_keys($default) as $key)
                    fputs($fp, $counters[$page][$key] . "\n");
            }

            // Close
            flock($fp, LOCK_UN);
            fclose($fp);

            return $counters[$page];
        }


    //Syntax: {{counter|total(default), today, or yesterday|texts following the number (when it is 0 or 1)|texts following the number (when it is 2 or more)}}
    //The texts following the number are not required (If entered just {{counter|today or yesterday or total}} or {{counter}}, this will return only the number)

    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('\{\{counter[^}]*\}\}',$mode,'plugin_accscounter_counter');
    }


    function handle($match, $state, $pos, Doku_Handler $handler){

        return explode('|', substr($match, strlen('{{counter|'), -2));

    }

    function render($mode, Doku_Renderer $renderer, $data) {
        // Counter file's suffix
        define('PLUGIN_COUNTER_SUFFIX', '.count');

        // Where the directory for counter files is?
        define('COUNTER_DIR', DOKU_PLUGIN . 'accscounter/log/');

        // Get the time zone from conf (if null, it will use the default setting on your server)
        if ($this->getConf('timezone') != '')  date_default_timezone_set($this->getConf('timezone'));

        // Get current time (local)
        define('CURRENT', time());


        // Main process
        global $INFO;

        switch ($data[0]) {
        case ''     :
        case 'total': $arg = 'total';
            break;
        case 'today': $arg = 'today';
            break;
        case 'yesterday': $arg = 'yesterday';
            break;
        default:
            $renderer->doc .= htmlspecialchars($this->getLang('err2'));
            return;
        }

        $counter = $this->plugin_counter_get_count($INFO['id']);
        if (gettype($counter) == "string") {
            $renderer->doc .= $counter;
        } else if ($counter[$arg] <= 1) {
            $renderer->doc .= htmlspecialchars($counter[$arg]) .htmlspecialchars($data[1]);
        } else {
            $renderer->doc .= htmlspecialchars($counter[$arg]) .htmlspecialchars($data[2]);
        }

    }

}
