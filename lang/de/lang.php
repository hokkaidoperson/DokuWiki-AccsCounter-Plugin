<?PHP

$lang['err1']    = 'Ein Fehler im Zugriffszähler-Plugin: Diese Datei kann nicht im Protokollverzeichnis geöffnet werden. ';
$lang['err2']    = 'Ein Fehler im Zugriffszähler-Plugin: Legen Sie ein gültiges Argument fest (heute [today], gestern [yesterday] oder insgesamt [total]).';
$lang['err3']    = 'Ein Fehler im Zugriffszähler-Plugin:  Legen Sie ein gültiges Argument fest (heute [today], gestern [yesterday] oder alle Zeiträume [allperiod]).';
$lang['err4']    = 'Ein Fehler im Zugriffszähler-Plugin: Dieses Verzeichnis wurde nicht gefunden oder ist nicht lesbar. ';
$lang['noitems'] = 'Es sind keine Elemente anzuzeigen.';

$lang['datanotice'] = '[Zugriffszähler-Plugin] Das Speicherziel der Daten dieses Plugins wurde geändert. Alte Daten werden noch nicht an das neue Ziel verschoben.  <a href="?do=accscounter_datatransfer">Klicken Sie hier, um die Daten zu verschieben oder zu löschen.</a>';
$lang['datanotice2'] = '[Zugriffszähler-Plugin] Das Speicherziel der Daten dieses Plugins wurde <b> WIEDER </ b> geändert. Alte Daten werden noch nicht an das neue Ziel verschoben. Es tut mir leid, Sie zu belästigen, aber bitte <a href="?do=accscounter_datatransfer"hier klicken, um die Daten zu verschieben oder zu löschen.</a>';
$lang['moveiplog'] = 'Protokolldaten von IP-Adressen verschieben';
$lang['success'] = 'erfolgreich';
$lang['failiplog'] = 'fehlgeschlagen (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf <code>/lib/plugins/accscounter/log/iplogs/</code>. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['movenmlog'] = 'Verschieben Sie die Protokolldaten mit der Anzahl der Zugriffe';
$lang['failnmdir'] = 'Das Verzeichnis konnte nicht gelesen werden. (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf <code>/lib/plugins/accscounter/log/iplogs/</code>. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['failnmload'] = 'Die Datei konnte nicht gelesen werden. (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns <code>/lib/plugins/accscounter/log/</code> haben. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['failnmsave'] = 'Die Datei konnte gelesen, aber nicht beschrieben werden. (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns für die Metadateien hat. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['failnmdel'] = 'Die Datei konnte gelesen und geschrieben, aber nicht gelöscht werden (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns <code>/lib/plugins/accscounter/log/</code> haben. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['failnmload2'] = 'Die Datei konnte nicht gelesen werden. (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns für die Metadateien hat.  Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['failnmdel2'] = 'Die Datei konnte gelesen und geschrieben, aber nicht gelöscht werden (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns für die Metadateien hat. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['complete'] = 'Verschieben der Dateien erfolgrich abgeschlossen. Das alte Verzeichnis kann nun gelöscht werden';
$lang['remaining'] = 'Fehler beim Löschen des Verzeichnisses des alten Zielspfades, <code>/lib/plugins/accscounter/log/</code>. Möglicherweise befinden sich noch einige Dateien im Verzeichnis. Überprüfen Sie dies bitte und löschen Sie das Verzeichnis bitte selbst mit einem FTP-Programm.';
$lang['allloaded'] = 'Das Plugin hat versucht, alle vorhandenen Protokolldateien zu laden und zu verschieben.';
$lang['nothing'] = 'Es muss keine Protokolldatei verschoben werden. Möglicherweise müssen Sie diese Funktion nicht ausführen.';
$lang['funcend'] = 'Aufgaben wurden alle durchgeführt.';
$lang['successdel'] = 'Das Löschen des Verzeichnisses <code>/lib/plugins/accscounter/log/</code> war erfolgreich.';
$lang['faildel'] = 'Das Löschen des Verzeichnisses <code>/lib/plugins/accscounter/log/</code> ist fehlgeschlagen. Möglicherweise befinden sich noch einige Dateien im Verzeichnis. Überprüfen Sie dies bitte und löschen Sie das Verzeichnis bitte selbst mit einem FTP-Programm.';
$lang['successdellog'] = 'Löschen erfolgreich';
$lang['faildellog'] = 'Löschen fehlgeschlagen (Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns für die Metadateien hat. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..)';
$lang['alldeleted'] = 'Das Plugin hat versucht, alle vorhandenen alten Protokolldateien zu löschen.';
$lang['nothingtodelete'] = 'Es muss keine Protokolldatei gelöscht werden. Möglicherweise müssen Sie diese Funktion nicht ausführen.';

$lang['menu'] = 'Zugriffszähler - Datenverwaltung und Konfiguration';

$lang['selectall'] = 'Alle auswählen';
$lang['pagename'] = 'Seitenname';
$lang['sofar'] = 'SA bisher';
$lang['lastdate'] = 'Letzter Zugriff um';
$lang['today'] = 'heutige SA';
$lang['yest'] = 'gestrige SA';
$lang['ipadd'] = 'IP-Adresse des letzten Benutzers';
$lang['pleasechoose'] = '**Auswählen**';
$lang['sfscheck'] = 'Spammer Prüfung';
$lang['delete'] = 'Logfiles löschen';
$lang['run'] = 'ausführen';

$lang['sfstried'] = 'Auf die Seite %s erfolgten von der Spammer-IP (%s) %d Zugriffe,daher hat das System die Anzahl der Spammerzugriffe von SAs bis jetzt und den heutigen SAs abgezogen. Bitte bestätigen Sie diese Bereinigung.';
$lang['sfsfinish'] = 'Die Spammerprüfung wurde abgeschlossen.';

$lang['mngfaileddel'] = 'Fehler beim Löschen der Protokolldatei von Seite %s.  Bitte prüfen Sie die Berechtigung der Wiki und des Servers, ob diese Zugriff auf Dateien im Verzeichns für die Metadateien hat. Bitte verschieben oder löschen Sie das Verzeichnis selbst mit einem FTP-Programm..';
$lang['mngdelfinish'] = 'Löschen des Protokolls abgeschlossen.';
