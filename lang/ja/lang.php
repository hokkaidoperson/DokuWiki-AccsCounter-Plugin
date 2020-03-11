<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 */
$lang['err1']                  = 'Accscounterプラグインでエラーが生じました: ログディレクトリの次のファイルを開けません; ';
$lang['err2']                  = 'Accscounterプラグインでエラーが生じました: 適切な引数を指定して下さい（today、yesterday、total のいずれか）。';
$lang['err3']                  = 'Accscounterプラグインでエラーが生じました: 適切な引数を指定して下さい（today、yesterday、allperiod のいずれか）。';
$lang['err4']                  = 'Accscounterプラグインでエラーが生じました: 次のディレクトリが見付からなかったか、書き込めませんでした; ';
$lang['noitems']               = '表示出来る項目がありません。';
$lang['datanotice']            = '[Accscounterプラグイン] プラグインのデータ保存先が変更となりました。これまでのログデータはまだ新しい保存先に移動されていません。<a href="?do=accscounter_datatransfer">こちらをクリックすると、ログデータを移動もしくは削除するメニューに移ります。</a>';
$lang['datanotice2']           = '[Accscounterプラグイン] プラグインのデータ保存先が <b>再び</b> 変更となりました。これまでのログデータはまだ新しい保存先に移動されていません。お手数をお掛けしますが、<a href="?do=accscounter_datatransfer">こちらをクリックして、ログデータを移動もしくは削除して下さい。</a>';
$lang['moveiplog']             = 'IPアドレスのログデータを移動';
$lang['success']               = '成功';
$lang['failiplog']             = '失敗（<code>/lib/plugins/accscounter/log/iplogs/</code>へのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でディレクトリを移動もしくは削除して下さい。）';
$lang['movenmlog']             = 'アクセス数のログデータを移動';
$lang['failnmdir']             = 'ディレクトリ読み込み失敗（<code>/lib/plugins/accscounter/log/</code>へのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmload']            = 'ファイル読み込み失敗（<code>/lib/plugins/accscounter/log/</code>内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmsave']            = '読み込み成功　書き込み失敗（メタファイルを保存するディレクトリへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmdel']             = '読み込み・書き込み成功　削除失敗（<code>/lib/plugins/accscounter/log/</code>内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。）';
$lang['failnmload2']           = 'ファイル読み込み失敗（メタファイルを保存するディレクトリ内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。）';
$lang['failnmdel2']            = '読み込み・書き込み成功　削除失敗（メタファイルを保存するディレクトリ内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。）';
$lang['complete']              = 'ファイルの移動が全て完了しました。移動元のディレクトリを削除しました。';
$lang['remaining']             = '移動元のディレクトリ（<code>/lib/plugins/accscounter/log/</code>）を削除出来ませんでした。移動元のディレクトリにファイルが残っている可能性がありますのでご確認下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを移動もしくは削除して下さい。';
$lang['allloaded']             = '存在する全てのログファイルの読み込み・移動を試行しました。';
$lang['nothing']               = '移動すべきログファイルがありません。恐らく、この機能を実行する必要は無いと思われます。';
$lang['funcend']               = '操作を完了しました。';
$lang['successdel']            = 'ディレクトリ（<code>/lib/plugins/accscounter/log/</code>）の削除に成功しました。';
$lang['faildel']               = 'ディレクトリ（<code>/lib/plugins/accscounter/log/</code>）を削除出来ませんでした。ディレクトリにファイルが残っている可能性がありますのでご確認下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。';
$lang['successdellog']         = '削除成功';
$lang['faildellog']            = '削除失敗（メタファイルを保存するディレクトリ内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。）';
$lang['alldeleted']            = '存在する全ての古いログファイルの削除を試行しました。';
$lang['nothingtodelete']       = '削除すべきログファイルがありません。恐らく、この機能を実行する必要は無いと思われます。';
$lang['menu']                  = 'アクセスカウンター - データマネージャー';
$lang['selectall']             = '全て選択';
$lang['pagename']              = 'ページ名';
$lang['sofar']                 = 'これまでのPV数';
$lang['lastdate']              = '最終アクセス日付';
$lang['today']                 = '今日のPV数';
$lang['yest']                  = '昨日のPV数';
$lang['ipadd']                 = '最終アクセス者のIPアドレス';
$lang['pleasechoose']          = '□□選択して下さい□□';
$lang['sfscheck']              = 'スパムチェック';
$lang['delete']                = 'ログ削除';
$lang['run']                   = '実行';
$lang['sfstried']              = 'ページ %s にスパム（IPアドレス：%s）によるアクセスが%d回あったため、これまでのPV数及び今日のPV数から、そのスパムからアクセスがあった回数分だけ差し引きました。ご確認下さい。';
$lang['sfsfinish']             = 'スパムチェックを終了しました。';
$lang['mngfaileddel']          = 'ページ %s のログファイルの削除に失敗しました。メタファイルを保存するディレクトリ内のファイルへのアクセス権を確認して下さい。よく分からない場合は、FTPツール等を用いて各自でファイルを削除して下さい。';
$lang['mngdelfinish']          = 'ログファイル削除を終了しました。';
