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
            global $conf;
            static $counters = array();
            static $default;

            $achelper = plugin_load('helper','accscounter');
            $clientIP = clientIP(true);

            if (! isset($default))
                $default = array(
                    'total'     => 0,
                    'date'      => date('Y/m/d'),
                    'today'     => 0,
                    'yesterday' => 0,
                    'ip'        => '');

            if (page_exists($page) == FALSE) return $default;
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

            $remotehost = gethostbyaddr($clientIP);
            $excluded = FALSE;
            foreach ($exlist as $checking) {
                $prefix = '/^' . $checking . '$/';
                if (preg_match($prefix, $clientIP)) $excluded = TRUE;
                if (preg_match($prefix, $remotehost)) $excluded = TRUE;
            }

            // Check about the country
            $countries = explode(',', $this->getConf('cntrExclusion'));
            $countries = array_map('trim', $countries);
            $countries = array_unique($countries);
            $countries = array_filter($countries);

            $countriesin = explode(',', $this->getConf('cntrInclusion'));
            $countriesin = array_map('trim', $countriesin);
            $countriesin = array_unique($countriesin);
            $countriesin = array_filter($countriesin);

            // Get a country code related to the user
            // Ingredients to generate a DNS address
            // Support for IPv6 requires a different approach
            // Check if the IP is IPv6
            if (filter_var($clientIP, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                // For IPv6, reverse the entire address
                $ingr = explode(":", $clientIP);
                // Pad each section to ensure it's fully represented
                foreach ($ingr as &$part) {
                    $part = str_pad($part, 4, '0', STR_PAD_LEFT);
                }
                unset($part); // Break the reference with the last element
                $reversedIP = implode(".", array_reverse($ingr));
                // Compose a "cc.wariate.jp" DNS address
                $dnsaddr = $reversedIP . ".ip6.arpa";
            } else {
                // Assume IPv4 if not IPv6
                $ingr = explode(".", $clientIP);
                // Compose a "cc.wariate.jp" DNS address
                $dnsaddr = $ingr[3] . "." . $ingr[2] . "." . $ingr[1] . "." . $ingr[0] . ".in-addr.arpa";
            }

            // Investigate now
            $dnsdatas = dns_get_record($dnsaddr, DNS_TXT);
            // Can only use the variable if it is defined
            if ($dnsdatas !== FALSE && !empty($dnsdatas)) $hiscountry = $dnsdatas[0]["txt"]; else $hiscountry = FALSE;

            // Check now
            if ($hiscountry !== FALSE) {
                $hiscountry = utf8_strtolower($hiscountry);
                foreach ($countries as $checking) {
                    $checkinglower = utf8_strtolower($checking);
                    if ($checkinglower == $hiscountry) $excluded = TRUE;
                }
                if ($this->getConf('cntrInclusion') != '') {
                    $included = FALSE;
                    foreach ($countriesin as $checking) {
                        $checkinglower = utf8_strtolower($checking);
                        if ($checkinglower == $hiscountry) $included = TRUE;
                    }
                    if ($included != TRUE) $excluded = TRUE;
                }
            }

            // Check about IPs reverse lookup
            if ($this->getConf('reverseLookupFailed') == '1' && $remotehost == $clientIP) {
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
                    if (preg_match($prefix, $clientIP)) $excluded = FALSE;
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

            // Check if the user is a spammer
            $ishespam = FALSE;
            $sfspluginok = FALSE;
            if (! plugin_isdisabled('stopforumspam2')) {
                if ($helper = plugin_load('helper','stopforumspam2')) {
                    $sfspluginok = TRUE;
                    if ($helper->quickipcheck(null, $this->getConf('sfsExFreq'), $this->getConf('sfsExConf'))) {
                        $ishespam = TRUE;
                        $excluded = TRUE;
                    }
                }
            }


            // Open
            $file = $achelper->counterFN($page, '.number');
            if (file_exists($file)) {
                $fp = io_readFile($file);
                if ($fp === FALSE) return $this->getLang('err1') . basename($file);
                $fp = explode("\n", $fp);
            } else $fp = array();

            // Read
            if ($fp[0]) $counters[$page]['total'] = $fp[0];
            if ($fp[1]) $counters[$page]['date'] = $fp[1];
            if ($fp[2]) $counters[$page]['today'] = $fp[2];
            if ($fp[3]) $counters[$page]['yesterday'] = $fp[3];
            if ($fp[4]) $counters[$page]['ip'] = $fp[4];

            // Anothoer day?
            if ($counters[$page]['date'] != $default['date']) {
                $modify = TRUE;
                $is_yesterday = ($counters[$page]['date'] == date('Y/m/d', CURRENT - 24 * 60 * 60));
                $counters[$page]['ip'] = $clientIP;
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
                        $logfiledir = $conf['cachedir'] . '/accscounterlog/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . utf8_strtolower(date('M-d-Y')) . '.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $clientIP ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;

                    case 'ppage' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = $conf['cachedir'] . '/accscounterlog/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . 'wholeperiod.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $clientIP ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;
                    }
                    if (file_exists($achelper->counterFN($page, '.ip'))) {
                        $ipdata = @file($achelper->counterFN($page, '.ip'));
                        if ($ipdata != FALSE) {
                            $inthelog = FALSE;
                            $newcontents = array();
                            foreach ($ipdata as $dataline) {
                                $element = explode('|', $dataline);
                                $element[0] = trim($element[0]);
                                $element[1] = trim($element[1]);
                                if ($clientIP == $element[0]) {
                                    $inthelog = TRUE;
                                    $element[1]++;
                                }
                                $newcontents[] = $element[0] . '|' . $element[1];
                            }
                            if (!$inthelog) $newcontents[] = $clientIP . '|1';
                            $writing = '';
                            foreach ($newcontents as $part) {
                                $writing .= $part . "\n";
                            }
                            io_saveFile($achelper->counterFN($page, '.ip'), $writing);
                        }
                    } else io_saveFile($achelper->counterFN($page, '.ip'), $clientIP . "|1\n");
                } else {
                    $counters[$page]['today']     = 0;
                }
            } else if ($counters[$page]['ip'] != $clientIP) {
                // Not the same host
                if ($excluded == FALSE) {
                    $modify = TRUE;
                    $counters[$page]['ip']        = $clientIP;
                    $counters[$page]['today']++;
                    $counters[$page]['total']++;

                    // Save the log?
                    switch ($this->getConf('saveLog')) {
                    case 'pdate' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = $conf['cachedir'] . '/accscounterlog/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . utf8_strtolower(date('M-d-Y')) . '.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $clientIP ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;

                    case 'ppage' :
                        $filepageid = str_replace(':','/',$page);
                        $logfiledir = $conf['cachedir'] . '/accscounterlog/' . utf8_encodeFN($filepageid) . '/';
                        if (!file_exists($logfiledir)) mkdir($logfiledir, 0777, true);
                        $logfilename = $logfiledir . 'wholeperiod.txt';
                        if ($loghandle = fopen($logfilename, 'a')) {
                            $logcontent = $clientIP ."(" . date('H:i:s M d, Y') . ")\n";
                            fwrite($loghandle, $logcontent);
                            fclose($loghandle);
                        }
                        break;
                    }
                    if (file_exists($achelper->counterFN($page, '.ip'))) {
                        $ipdata = @file($achelper->counterFN($page, '.ip'));
                        if ($ipdata != FALSE) {
                            $inthelog = FALSE;
                            $newcontents = array();
                            foreach ($ipdata as $dataline) {
                                $element = explode('|', $dataline);
                                $element[0] = trim($element[0]);
                                $element[1] = trim($element[1]);
                                if ($clientIP == $element[0]) {
                                    $inthelog = TRUE;
                                    $element[1]++;
                                }
                                $newcontents[] = $element[0] . '|' . $element[1];
                            }
                            if (!$inthelog) $newcontents[] = $clientIP . '|1';
                            $writing = '';
                            foreach ($newcontents as $part) {
                                $writing .= $part . "\n";
                            }
                            io_saveFile($achelper->counterFN($page, '.ip'), $writing);
                        }
                    } else io_saveFile($achelper->counterFN($page, '.ip'), $clientIP . "|1\n");
                }
            }

            // Modify
            if ($ACT == '' or $ACT == 'show') $showing = TRUE;

            if ($modify && $showing == TRUE) {
                $savedata = '';
                foreach (array_keys($default) as $key)
                    $savedata .= $counters[$page][$key] . "\n";
                io_saveFile($file, $savedata);
            }

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
        global $INFO;

        // Get the time zone from conf (if null, it will use the default setting on your server)
        if ($this->getConf('timezone') != '')  date_default_timezone_set($this->getConf('timezone'));

        // Get current time (local)
        // Should only define the constant once
        (!defined('CURRENT')) ? define('CURRENT', time()) : null;


        // Main process

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
            // Can only use the variable if it is defined
            $renderer->doc .= htmlspecialchars($counter[$arg]) .htmlspecialchars(isset($data[1])?$data[1]:'');
        } else {
            $renderer->doc .= htmlspecialchars($counter[$arg]) .htmlspecialchars($data[2]);
        }

    }

}
