<?PHP

$lang['err1']    = 'An error on Accscounter plugin: Cannot open the log directory\'s this file; ';
$lang['err2']    = 'An error on Accscounter plugin: Set a valid argument (today, yesterday, or total).';
$lang['err3']    = 'An error on Accscounter plugin: Set a valid argument (today, yesterday, or allperiod).';
$lang['err4']    = 'An error on Accscounter plugin: This directory is not found or not readable; ';
$lang['noitems'] = 'There are no items to be shown.';

$lang['datanotice'] = '[Accscounter Plugin] The saving destination of this plugin\'s data has been changed.  Old datas are not still moved to the new destination.  <a href="?do=accscounter_datatransfer">Click here to move or delete the data.</a>';
$lang['datanotice2'] = '[Accscounter Plugin] The saving destination of this plugin\'s data has been changed <b>AGAIN</b>.  Old datas are not still moved to the new destination.  I\'m sorry to trouble you, but <a href="?do=accscounter_datatransfer">click here to move or delete the data.</a>';
$lang['moveiplog'] = 'Move log data of IP addresses';
$lang['success'] = 'succeeded';
$lang['failiplog'] = 'failed (Confirm the permission to access <code>/lib/plugins/accscounter/log/iplogs/</code>.  If you don\'t understand what it says, move or delete the directory by yourself with tools like a FTP tool.)';
$lang['movenmlog'] = 'Move log data of the number of accesses';
$lang['failnmdir'] = 'failed to read the directory (Confirm the permission to access <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmload'] = 'failed to read the file (Confirm the permission to access files inside <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmsave'] = 'succeeded reading, but failed writing (Confirm the permission to access the directory where the system saves meta files.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmdel'] = 'succeeded reading and writing, but failed deleting (Confirm the permission to access files inside <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, delete the files by yourself with tools like a FTP tool.)';
$lang['failnmload2'] = 'failed to read the file (Confirm the permission to access files inside the directory where the system saves meta files.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmdel2'] = 'succeeded reading and writing, but failed deleting (Confirm the permission to access files inside the directory where the system saves meta files.  If you don\'t understand what it says, delete the files by yourself with tools like a FTP tool.)';
$lang['complete'] = 'Completed moving files.  Deleted the directory of the old destination.';
$lang['remaining'] = 'Failed deleting the directory of the old destination, <code>/lib/plugins/accscounter/log/</code>.  There may be still some file(s) in the directory, so please check.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.';
$lang['allloaded'] = 'The plugin tried loading and moving all log files existing.';
$lang['nothing'] = 'There is no log file to be moved.  Maybe no need to run this function.';
$lang['funcend'] = 'Functions were all done.';
$lang['successdel'] = 'Succeeded deleting directory <code>/lib/plugins/accscounter/log/</code>.';
$lang['faildel'] = 'Failed deleting directory <code>/lib/plugins/accscounter/log/</code>.  There may be still some file(s) in the directory, so please check.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.';
$lang['successdellog'] = 'succeeded deleting';
$lang['faildellog'] = 'failed deleting (Confirm the permission to access files inside the directory where the system saves meta files.  If you don\'t understand what it says, delete the files by yourself with tools like a FTP tool.)';
$lang['alldeleted'] = 'The plugin tried deleting all old log files existing.';
$lang['nothingtodelete'] = 'There is no log file to be deleted.  Maybe no need to run this function.';

$lang['menu'] = 'Access Counter - Data Manager';

$lang['selectall'] = 'Tick all';
$lang['pagename'] = 'page name';
$lang['sofar'] = 'PVs so far';
$lang['lastdate'] = 'Last accessed on';
$lang['today'] = 'Today\'s PVs';
$lang['yest'] = 'Yesterday\'s PVs';
$lang['ipadd'] = 'IP address of the last visitor';
$lang['pleasechoose'] = '**CHOOSE**';
$lang['sfscheck'] = 'Spammer Check';
$lang['delete'] = 'Delete the Log';
$lang['run'] = 'Run';

$lang['sfstried'] = 'Page %s has been accessed by a spammer (IP address: %s) for %d times, so the system deducted the number of the spammer\'s access(es) from PVs so far and today\'s PVs.  Please comfirm.';
$lang['sfsfinish'] = 'Finished the spammer check.';

$lang['mngfaileddel'] = 'Failed deleting the log file of page %s .  Confirm the permission to access files inside the directory where the system saves meta files.  If you don\'t understand what it says, delete the files by yourself with tools like a FTP tool.';
$lang['mngdelfinish'] = 'Finished deleting the log.';
