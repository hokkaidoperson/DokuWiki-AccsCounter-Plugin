<?PHP

$lang['err1']    = 'An error on Accscounter plugin: Cannot open the log directory\'s this file; ';
$lang['err2']    = 'An error on Accscounter plugin: Set a valid argument (today, yesterday, or total).';
$lang['err3']    = 'An error on Accscounter plugin: Set a valid argument (today, yesterday, or allperiod).';
$lang['err4']    = 'An error on Accscounter plugin: This directory is not found or not readable; ';
$lang['noitems'] = 'There are no items to be shown.';

$lang['datanotice'] = '[Accscounter Plugin] The saving destination of this plugin\'s data has been changed.  Old datas are not still moved to the new destination.  <a href="?do=accscounter_datatransfer">Click here to move or delete the data.</a>';
$lang['noneed'] = 'No need to move the data.';
$lang['moveiplog'] = 'Move log data of IP addresses';
$lang['success'] = 'succeeded';
$lang['failiplog'] = 'failed (Confirm the permission to access <code>/lib/plugins/accscounter/log/iplogs/</code>.  If you don\'t understand what it says, move or delete the directory by yourself with tools like a FTP tool.)';
$lang['movenmlog'] = 'Move log data of the number of accesses';
$lang['failnmdir'] = 'failed to read the directory (Confirm the permission to access <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmload'] = 'failed to read the file (Confirm the permission to access files inside <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmsave'] = 'succeeded reading, but failed writing (Confirm the permission to access the directory where the system saves meta files.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.)';
$lang['failnmdel'] = 'succeeded reading and writing, but failed deleting (Confirm the permission to access files inside <code>/lib/plugins/accscounter/log/</code>.  If you don\'t understand what it says, delete the files by yourself with tools like a FTP tool.)';
$lang['complete'] = 'Completed moving files.  Deleted the directory of the old destination.';
$lang['remaining'] = 'Failed deleting the directory of the old destination, <code>/lib/plugins/accscounter/log/</code>.  There may be still some file(s) in the directory, so please check.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.';
$lang['funcend'] = 'Functions were all done.';
$lang['successdel'] = 'Succeeded deleting directory <code>/lib/plugins/accscounter/log/</code>.';
$lang['faildel'] = 'Failed deleting directory <code>/lib/plugins/accscounter/log/</code>.  There may be still some file(s) in the directory, so please check.  If you don\'t understand what it says, move or delete the files by yourself with tools like a FTP tool.';
