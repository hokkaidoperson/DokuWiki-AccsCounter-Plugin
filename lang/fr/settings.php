<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Schplurtz le Déboulonné <schplurtz@laposte.net>
 */
$lang['timezone']              = 'Fuseau horaire utilisé pour décider du changement de jour. Si vide, le fuseau du serveur est utilisé. Vous pouvez utiliser l\'un des identifiants (ID) de la <a href="http://php.net/manual/en/timezones.php" target="_blank">liste des fuseaux horaires compris par PHP</a> du manuel de PHP. (Le lien s\'ouvre dans un nouvel onglet).';
$lang['excludeMgAndSp']        = 'Ne pas compter les manageurs et administrateurs. Veuillez vous reporter à <a href="#config___manager">manageur</a>" et "<a href="#config___superuser">administrateur</a>".';
$lang['exclusionList']         = 'Adresses IP et hôtes distant à exclure<br>Le greffon ne compte pas les utilisateurs de ces adresses et hôtes distants. Cette liste est utile si votre site a de nombreuse visites de robots des hôtes ou IP spécifiées.<br>Le greffon obtient les noms d\'hôte distant par des requêtes DNS inverses (<code><a href="https://www.php.net/manual/fr/function.gethostbyaddr.php" target="_blank">gethostbyaddr</a></code>.<br>Entrez une adresse IP ou nom d\'hôte par ligne.<br>patrons disponibles<br><code>?</code> = un caractère alphanumérique, un point (<code>.</code>), ou un tiret (<code>-</code>)<br><code>*</code> = un ou plusieurs caractères alphanumériques, points (<code>.</code>), ou tirets (<code>-</code>)<br>
! = un caractère numérique<br>
~ = un ou plusieurs caractères numériques<br>
exemple1 "123.456.???.123" -> 123.456.789.123, etc. (123.456.78.123 sera inclus)<br>
exemple 2 "*.example.com" -> 123.456.789.123.example.com, 1-2-3-4.rooter.example.com, etc.';
$lang['reverseLookupFailed']   = 'Ne pas comptabiliser les adresses pour lesquelles la résolution DNS inverse (IP vers nom) échoue. Les adresses des robots ont tendance à rejeter les résolutions inverses.';
$lang['reverseLookupException'] = 'Adresses IP auxquelles ne pas appliquer l\'option "résolution DNS inverse échouée"<br>Une adresse par ligne,<br>patrons disponibles<br><code>?</code> = un caractère<br><code>*</code> = un ou plusieurs caractères.<br>exemple 1 “123.456.???.123” -> 123.456.789.123, etc. (123.456.78.123 sera inclus)<br>exemple 2 “123.*.789.123” -> 123.456.789.123, 123.9.789.123, etc.
';
$lang['reverseLookupCntrException'] = 'Pays auxquels ne pas appliquer l\'option "résolution DNS inverse échouée"<br>Le greffon obtient les code de pays par le service DNS "cc.wariate.jp" (<a href="http://cc.wariate.jp/" target="_blank">Details en japonais</a>).<br>Entrez des codes de pays à deux lettre selon la <a href="https://fr.wikipedia.org/wiki/ISO_3166" target="_blank">norme ISO 3166-1 alpha-2</a>, séparés par des virgules.';
$lang['usrExclusion']          = 'Utilisateurs ou groupes à exclure.<br>Le greffon ne compte ni ces utilisateurs ni ceux de ces groupes.<br>Veuillez saisir les noms séparés par des virgules.';
$lang['cntrExclusion']         = 'Pays à exclure<br>Le greffon ne comptabilisera pas les visites de ces pays. Cette liste peut être utile si votre site reçoit de nombreuses visites de robots de certains pays.<br>Le greffon obtient les code de pays par le service DNS "cc.wariate.jp" (<a href="http://cc.wariate.jp/" target="_blank">Details en japonais</a>).<br>Entrez des codes de pays à deux lettre selon la <a href="https://fr.wikipedia.org/wiki/ISO_3166" target="_blank">norme ISO 3166-1 alpha-2</a>, séparés par des virgules.';
$lang['cntrInclusion']         = 'Seulement inclure ces pays.<br>Le greffon ne comptabilisera <em>QUE</em> les visites de ces pays.<br>Le greffon obtient les code de pays par le service DNS "cc.wariate.jp" (<a href="http://cc.wariate.jp/" target="_blank">Details en japonais</a>).<br>Entrez des codes de pays à deux lettre selon la <a href="https://fr.wikipedia.org/wiki/ISO_3166" target="_blank">norme ISO 3166-1 alpha-2</a>, séparés par des virgules.';
$lang['sfsExFreq']             = 'Vérifier le score de fréquence des adresses IP des visiteur pour ne pas compter les spammeurs ? (Le greffon [[doku>plugin:stopforumspam2|StopForumSpam2]] est nécessaire.)<br>
Utilisez 0 pour désactiver. -1 pour utiliser la valeur du paramètre freqBorder du greffon Stopforumspam2, ou une valeur positive pour définir la limite.';
$lang['sfsExConf']             = 'Vérifier l\'indice de confiance de l\'adresse IP des visiteurs pour ne pas compter les spammeurs ?  (Le greffon [[doku>plugin:stopforumspam2|StopForumSpam2]] est nécessaire.)<br>
utilisez 0 pour désactiver, -1 pour utiliser la valeur du paramètre confidenceBorder du greffon Stopforumspam2, ou une valeur entre 1 et 100 inclus pour définir la limite.';
$lang['saveLog']               = 'Enregistrer le journal des adresses IP, date et heure des visites ?<br>
Un journal sera enregistré pour chaque page. Cette option est utile si vous décidez quels adresses IP, hôtes distants, ou pays exclure de la comptabilisation.<br>
Les fichiers journaux seront enregistrés dans le dossier <code>accscounterlog</code> du dossier <code>cache</code> (dans le <a href="#config___savedir">dossier d\'enregistrement des données</a>, par défaut, <code>data</code>). Choisissez et supprimez les fichiers journaux si nécessaire.';
$lang['excludeMgAndSp_o_0']    = 'Comptabiliser les deux';
$lang['excludeMgAndSp_o_sp']   = 'Ne pas comptabiliser les administrateurs';
$lang['excludeMgAndSp_o_mg']   = 'Ne pas  comptabiliser les gestionnaires (administrateurs compris)';
$lang['saveLog_o_0']           = 'Ne pas enregistrer';
$lang['saveLog_o_ppage']       = 'Enregistrer (Ne pas créer de fichier pour chaque date)';
$lang['saveLog_o_pdate']       = 'Enregistrer (Créer un fichier par date)';
$lang['ipgdpr']                = 'Faut-il anonymiser les adresses IP pour respecter le RGPD ?<br>Désactiver cette option pour obtenir les IP des spammeurs et robots, puis réactivez là. il faudra également supprimer ou nettoyer les journaux du serveur avec un programme FTP. La détection des spammeurs et robots est possible malgré l\'activation de cette fonction.';
