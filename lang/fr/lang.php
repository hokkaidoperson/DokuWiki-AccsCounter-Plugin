<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 *
 * @author Schplurtz le Déboulonné <schplurtz@laposte.net>
 */
$lang['err1']                  = 'Une erreur du greffon Accscounter : impossible d\'ouvrir le dossier de ce fichier journal :';
$lang['err2']                  = 'Une erreur du greffon Accscounter : Saisissez un paramètre valide (today, yesterday, ou total).';
$lang['err3']                  = 'Une erreur du greffon Accscounter : Saisissez un paramètre valide (today, yesterday, ou allperiod).';
$lang['err4']                  = 'Une erreur du greffon Accscounter : Ce dossier est introuvable ou illisible :';
$lang['noitems']               = 'Il n\'y a aucun article à afficher.';
$lang['datanotice']            = '[Greffon Accscounter]: La destination pour l\'enregistrement des données de ce greffon a changé. les anciennes données n\'ont pas été déplacées. <a href="?do=accscounter_datatransfer">Suivez ce lien pour déplacer ou supprimer les données</a>.';
$lang['datanotice2']           = '[Greffon Accscounter]: La destination pour l\'enregistrement des données de ce greffon a <em>ENCORE</em> changé <b>. les anciennes données ne sont toujours pas déplacées.  Je suis désolé de vous déranger, mais veuillez <a href="?do=accscounter_datatransfer">suivre ce lien pour déplacer ou supprimer les données</a>.';
$lang['moveiplog']             = 'Déplacer le journal des adresses IP';
$lang['success']               = 'a réussi';
$lang['failiplog']             = 'a échoué. (Confirmez l\'autorisation d\'accéder à <code>lib/plugins/accscounter/log/iplogs/</code>.  Si vous ne comprenez pas ce message, déplacez ou supprimez le dossier vous même, avec un outil du genre FTP.)';
$lang['movenmlog']             = 'Déplacer le journal du nombre d\'accès';
$lang['failnmdir']             = 'a échoué à lire le dossier. (Confirmez l\'autorisation d\'accéder à <code>lib/plugins/accscounter/log/</code>.  Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['failnmload']            = 'a échoué à lire le fichier (Confirmez l\'autorisation d\'accéder aux fichiers du dossier <code>lib/plugins/accscounter/log/</code>.  Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['failnmsave']            = 'a réussi à lire, mais échoué à écrire (Confirmez l\'autorisation d\'accéder au dossier contenant les méta-fichiers. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['failnmdel']             = 'a réussi à lire et à écrire, mais a échoué à supprimer (Confirmez l\'autorisation d\'accéder aux fichiers du dossier <code>lib/plugins/accscounter/log/</code>. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['failnmload2']           = 'a échoué à lire le fichier. (Confirmez l\'autorisation d\'accéder aux fichiers du dossier où le système sauvegarde les méta-fichiers. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['failnmdel2']            = 'a réussi à lire et à écrire, mais a échoué à supprimer (Confirmez l\'autorisation d\'accéder aux fichiers du dossier où le système sauvegarde les méta-fichiers. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['complete']              = 'a terminé de déplacer les fichiers et a supprimé le dossier de l\'ancienne destination';
$lang['remaining']             = 'a échoué a supprimer le dossier de l\'ancienne destination <lib/plugins/accscounter/log/</code>. Il pourrait toujours y avoir des fichiers dans ce dossier ; veuillez vérifier. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['allloaded']             = 'Le greffon a essayé de charger et déplacer tous les fichiers journaux existant.';
$lang['nothing']               = 'Il n\'y a aucun fichier journal à déplacer. Peut-être est-il inutile de lancer cette fonction.';
$lang['funcend']               = 'Toutes les fonctions ont été réalisées.';
$lang['successdel']            = 'Suppression du dossier <code>/lib/plugins/accscounter/log/</code> réussie.';
$lang['faildel']               = 'Échec de la suppression du dossier <code>/lib/plugins/accscounter/log/</code>.  Il pourrait toujours y avoir des fichiers dans ce dossier ; veuillez vérifier. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['successdellog']         = 'a réussi à supprimer';
$lang['faildellog']            = 'a échoué a supprimer. (Confirmez l\'autorisation d\'accéder aux fichiers du dossier où le système sauvegarde les méta-fichiers. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['alldeleted']            = 'Le greffon a tenté de supprimer tous les anciens fichiers journaux existants.';
$lang['nothingtodelete']       = 'Il n\'y a aucun fichier journal à supprimer. Peut-être est-il inutile de lancer cette fonction.';
$lang['menu']                  = 'Compteur d\'accès - Gestionnaire de données';
$lang['selectall']             = 'Cocher tout';
$lang['pagename']              = 'nom de page';
$lang['sofar']                 = 'Vues jusque là';
$lang['lastdate']              = 'Dernier accès';
$lang['today']                 = 'Vues de ce jour';
$lang['yest']                  = 'Vues d\'hier';
$lang['ipadd']                 = 'Adresse IP du dernier visiteur';
$lang['pleasechoose']          = '**CHOISISSEZ**';
$lang['sfscheck']              = 'Vérification des spammeurs';
$lang['delete']                = 'Supprimer le journal';
$lang['run']                   = 'Exécuter';
$lang['sfstried']              = 'La page %s a été visitée par un spammeur (IP : %s) %d fois. Le système a donc déduit ce nombre d\'accès des vues jusque là et des vues du jour. Veuillez confirmer.';
$lang['sfsfinish']             = 'Fin des vérification de spammer.';
$lang['mngfaileddel']          = 'Échec de la suppression du journal de la page %s. (Confirmez l\'autorisation d\'accéder aux fichiers du dossier où le système sauvegarde les méta-fichiers. Si vous ne comprenez pas ce message, déplacez ou supprimez les fichiers vous même, avec un outil du genre FTP.)';
$lang['mngdelfinish']          = 'Suppression du journal terminée.';
