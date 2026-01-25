<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

$requestTable = 'mne_project_timelines';
$strTableName = 'mne_project_timelines';
$requestPage = "chart";

require_once("include/dbcommon.php");
require_once('include/xtempl.php');
require_once('classes/ganttpage.php');
require_once('classes/searchclause.php');
add_nocache_headers();

if( Security::hasLogin() ) {
	if( !Security::processPageSecurity( $strTableName, 'S' ) )
		return;
}

$pageMode = GanttPage::readGanttModeFromRequest();
$xt = new Xtempl();

// set params for a RunnerPage constructor
$params = array();
$params["id"] = postvalue_number("id");
$params["xt"] = &$xt;
$params["mode"] = $pageMode;
$params["tName"] = $strTableName;
$params["pageType"] = PAGE_GANTT;
$params["pageName"] = postvalue("page");
$params["action"] = postvalue( 'a' );

$params["masterPageType"] = postvalue("masterpagetype");
$params["masterTable"] = postvalue("mastertable");
if( $params["masterTable"] )
	$params["masterKeysReq"] =  RunnerPage::readMasterKeysFromRequest();
 
if( $pageMode = GANTT_DASHBOARD )
{
	$params["dashElementName"] = postvalue("dashelement");
	$params["dashTName"] = postvalue("table");
	$params["dashPage"] = postvalue("dashPage");
}

$pageObject = new GanttPage( $params );
$pageObject->init();

if( $pageObject->processSaveSearch() )
	exit();

$pageObject->process();
?>