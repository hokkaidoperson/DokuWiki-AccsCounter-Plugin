<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author HokkaidoPerson <dosankomali@yahoo.co.jp>
 */
$lang['timezone']              = 'タイムゾーン（日付変更の判断に利用します。空欄の場合は、サーバーにセッティングされたタイムゾーンを利用します。指定出来るのは、<a href="http://php.net/manual/ja/timezones.php" target="_blank">PHPマニュアルの「サポートされるタイムゾーンのリスト」〔新しいタブで開きます〕</a>にあるIDです。）';
$lang['excludeMgAndSp']        = 'マネージャーやスーパーユーザーをカウントするかどうか（設定「<a href="#config___manager">manager</a>」「<a href="#config___superuser">superuser</a>」参照）';
$lang['exclusionList']         = '除外するIP・リモートホスト<br>これらのIPやリモートホストからのアクセスはカウントされません。特定のIPやリモートホストからロボットによるアクセスが多い場合などにご活用下さい。<br>リモートホストは、IPアドレスからの逆引き（gethostbyaddr）によって取得します。<br>除外するIPやリモートホストを、1行ごとに1つ入力して下さい。<br>次のワイルドカードが使えます。<br>? = 1文字（半角英数字、ドット"."、ハイフン"-"）<br>* = 1文字以上（半角英数字、ドット"."、ハイフン"-"）<br>! = 1文字（半角数字のみ）<br>~ = 1文字以上（半角数字のみ）<br><br>例："123.456.???.123"⇒123.456.789.123 など（123.456.78.123は除外されません）<br>例："*.example.com"⇒123.456.789.123.example.com、1-2-3-4.rooter.example.com など';
$lang['reverseLookupFailed']   = 'IP→リモートホスト の逆引きに失敗した場合、カウンターから除外する（ロボットのIPアドレスは逆引きを拒否するケースが多いです）';
$lang['reverseLookupException'] = '上のオプション「reverseLookupFailed」の例外となるIPアドレス<br>対象のIPを、1行ごとに1つ入力して下さい。<br>次のワイルドカードが使えます。 <br>? = 1文字<br>* = 1文字以上<br><br>例："123.456.???.123"⇒123.456.789.123 など（123.456.78.123は除外されません）<br>例："123.*.789.123"⇒123.456.789.123、123.9.789.123 など';
$lang['reverseLookupCntrException'] = '上のオプション「reverseLookupFailed」の例外となる国<br>国コードは、「cc.wariate.jp」のDNSサービスにより取得します（<a href="http://cc.wariate.jp/" target="_blank">日本語による詳細</a>）。<br>2文字の国コード（ISO 3166-1 alpha-2）を、半角カンマ区切りで入力して下さい。';
$lang['usrExclusion']          = '除外するユーザー・ユーザーグループ<br>ここで指定したユーザー及びユーザーグループに所属するユーザーからのアクセスはカウントされません。<br>除外するユーザーあるいはユーザーグループを、半角カンマ区切りで入力して下さい。';
$lang['cntrExclusion']         = '除外する国<br>これらの国からのアクセスはカウントされません。特定の国からロボットによるアクセスが多い場合などにご活用下さい。<br>国コードは、「cc.wariate.jp」のDNSサービスにより取得します（<a href="http://cc.wariate.jp/" target="_blank">日本語による詳細</a>）。<br>2文字の国コード（ISO 3166-1 alpha-2）を、半角カンマ区切りで入力して下さい。';
$lang['cntrInclusion']         = 'カウントする国の指定<br>このオプションで国を指定すると、これらの国からのアクセス「のみ」カウントされます。<br>国コードは、「cc.wariate.jp」のDNSサービスにより取得します（<a href="http://cc.wariate.jp/" target="_blank">日本語による詳細</a>）。<br>2文字の国コード（ISO 3166-1 alpha-2）を、半角カンマ区切りで入力して下さい。';
$lang['sfsExFreq']             = '訪問者のIPアドレスのFrequency Scoreをチェックしてスパムをカウンターから除外するかどうか（Stopforumspam2プラグインが必要です）<br>"0"を入力するとチェックを行いません。0でない場合はチェックします。このオプション特有の基準値を指定出来ます。"-1"を入力すると、Stopforumspam2プラグインの設定"freqBorder"で指定した値が基準値となりますが、0より大きい値を入力すると、それが基準値となります。';
$lang['sfsExConf']             = '訪問者のIPアドレスのConfidence Scoreをチェックしてスパムをカウンターから除外するかどうか（Stopforumspam2プラグインが必要です）<br>"0"を入力するとチェックを行いません。0でない場合はチェックします。このオプション特有の基準値を指定出来ます。"-1"を入力すると、Stopforumspam2プラグインの設定"confidenceBorder"で指定した値が基準値となりますが、0より大きい値（100以下）を入力すると、それが基準値となります。';
$lang['saveLog']               = 'Wikiにアクセスがあった際にIPアドレスと日付時刻を記録する<br>ログはページ毎に保存されます。カウンターから除外するIPアドレスやリモートホスト、国を決める際にご活用下さい。<br>ログファイルは、キャッシュディレクトリ（デフォルトの設定の場合は<a href="#config___savedir">データディレクトリ</a>内にある）の<code>accscounterlog</code>ディレクトリ内に保存されます。必要に応じてファイルの抽出や削除を行って下さい。';
$lang['excludeMgAndSp_o_0']    = 'カウントする';
$lang['excludeMgAndSp_o_sp']   = 'スーパーユーザーはカウントしない';
$lang['excludeMgAndSp_o_mg']   = 'マネージャー（スーパーユーザー含む）はカウントしない';
$lang['saveLog_o_0']           = '記録しない';
$lang['saveLog_o_ppage']       = '記録する（ファイルを日付ごとに分ける事はしない）';
$lang['saveLog_o_pdate']       = '記録する（ファイルは日付ごとに分ける）';
$lang['ipgdpr']                = 'GDPR（EU一般データ保護規則）の要件を満たすためにIPアドレスを匿名化する必要がある場合はこのオプションを有効化して下さい。<br>スパム・ボットのIPアドレスを取得する場合、この機能を一旦無効にしてから再度有効化し、FTPプログラムを用いて、ログを削除するか個人情報を取り除いて下さい。スパム・ボットの検出は、このオプションの有効無効に関わらず常に行われます。';
