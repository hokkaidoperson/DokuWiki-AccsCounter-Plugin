<?php

$meta['timezone'] = array('string');
$meta['excludeMgAndSp'] = array('multichoice','_choices' => array('0','sp','mg'));
$meta['exclusionList'] = array('');
$meta['usrExclusion'] = array('string');
$meta['cntrExclusion'] = array('string');
$meta['reverseLookupFailed'] = array('onoff');
$meta['reverseLookupException'] = array('');
$meta['reverseLookupCntrException'] = array('string');
$meta['saveLog'] = array('multichoice','_choices' => array('0','ppage','pdate'));
