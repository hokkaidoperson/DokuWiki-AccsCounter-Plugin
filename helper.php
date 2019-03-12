<?PHP
/**
 * Access Counter and Popularity Plugin - Helper Section
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     HokkaidoPerson <dosankomali@yahoo.co.jp>
 */

if(!defined('DOKU_INC')) die();


class helper_plugin_accscounter extends DokuWiki_Plugin {

/**
 * returns the full path to the file of counter's data specified by ID and extension
 * A fork of the function metaFN, originally written by Steven Danz <steven-danz@kc.rr.com>
 *
 * @author HokkaidoPerson <dosankomali@yahoo.co.jp>
 *
 * @param string $id   page id
 * @param string $ext  file extension
 * @return string full path
 */
    function counterFN($id,$ext){
        global $conf;
        $id = cleanID($id);
        $id = str_replace(':','/',$id);
        $fn = $conf['metadir'].'/_accscounter/'.utf8_encodeFN($id).$ext;
        return $fn;
    }

}
