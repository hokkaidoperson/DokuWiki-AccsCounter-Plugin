<?PHP

$lang['err1']    = 'Accscounterプラグインでエラーが生じました: ログディレクトリの次のファイルを開けません; ';
$lang['err2']    = 'Accscounterプラグインでエラーが生じました: 適切な引数を指定して下さい（today、yesterday、total のいずれか）。';
$lang['err3']    = 'Accscounterプラグインでエラーが生じました: 適切な引数を指定して下さい（today、yesterday、allperiod のいずれか）。';
$lang['err4']    = 'Accscounterプラグインでエラーが生じました: 次のディレクトリが見付からなかったか、書き込めませんでした; ';
$lang['noitems'] = '表示出来る項目がありません。';

$lang['datanotice'] = '[Accscounterプラグイン] プラグインのデータ保存先が変更となりました。これまでのログデータはまだ新しい保存先に移動されていません。<a href="?do=accscounter_datatransfer">こちらをクリックすると、ログデータを移動もしくは削除するメニューに移ります。</a>';
$lang['noneed'] = 'データ移動の必要はありません。';
$lang['moveiplog'] = 'IPアドレスのログデータを移動';
$lang['success'] = '成功';
$lang['failiplog'] = '失敗（<code>/lib/plugins/accscounter/log/iplogs/</code>へのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でディレクトリを移動もしくは削除して下さい。）';
$lang['movenmlog'] = 'アクセス数のログデータを移動';
$lang['failnmdir'] = 'ディレクトリ読み込み失敗（<code>/lib/plugins/accscounter/log/</code>へのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmload'] = 'ファイル読み込み失敗（<code>/lib/plugins/accscounter/log/</code>内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmsave'] = '読み込み成功　書き込み失敗（メタファイルを保存するディレクトリへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmdel'] = '読み込み・書き込み成功　削除失敗（<code>/lib/plugins/accscounter/log/</code>内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。）';
$lang['complete'] = 'ファイルの移動が全て完了しました。移動元のディレクトリを削除しました。';
$lang['remaining'] = '移動元のディレクトリ（<code>/lib/plugins/accscounter/log/</code>）を削除出来ませんでした。移動元のディレクトリにファイルが残っている可能性がありますのでご確認下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。';
$lang['funcend'] = '操作を完了しました。';
$lang['successdel'] = 'ディレクトリ（<code>/lib/plugins/accscounter/log/</code>）の削除に成功しました。';
$lang['faildel'] = 'ディレクトリ（<code>/lib/plugins/accscounter/log/</code>）を削除出来ませんでした。ディレクトリにファイルが残っている可能性がありますのでご確認下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。';
