<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Schplurtz le Déboulonné <Schplurtz@laposte.net>
 */
$lang['timezone']              = 'Fuseau horaire utilisée pour déterminer le changement de jour (Si vide, le réglage du serveur sera utilisé). Vous pouvez indiquer l\'un des identifiants de la <a href="https://www.php.net/manual/fr/timezones" target="_blank">"Liste des Fuseaux Horaires Reconnus"</a> du manuel de PHP (cliquez pour ouvrir la page dans une nouvelle fenêtre.).';
$lang['reverseLookupFailed']   = 'Exclure du compte lorsque la résolution inverse (IP vers nom) échoue. (Les ips des robots on tendance à refuser la résolution inverse)';
$lang['reverseLookupException'] = 'IP  pour lesquelles l\'option "reverseLookupFailed" ne s\'applique pas.<br>Un par ligne<br>Jokers disponibles:<br>&npsp;&nbsp;? = un seul caractère<br>&npsp;&nbsp;* = un caractère ou plus<br><br>e.g. : "123.456.???.123" -> 123.456.789.123, etc. (123.456.78.123 ne sera pas exlus)<br>e.g.: "123.*.789.123" -> 123.456.789.123, 123.9.789.123, etc.';
$lang['excludeMgAndSp_o_0']    = 'Compter les deux';
$lang['excludeMgAndSp_o_sp']   = 'Ne pas compter les administrateurs';
$lang['excludeMgAndSp_o_mg']   = 'Nes pas compter les gestionnaires (y compris les administrateurs)';
$lang['saveLog_o_ppage']       = 'Enregistrer (Ne pas créer un fichier par date)';
$lang['saveLog_o_pdate']       = 'Enregistrer (Créer un fichier par date)';
