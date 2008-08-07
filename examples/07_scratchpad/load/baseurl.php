<?
return rtrim( substr( dirname($_SERVER['SCRIPT_FILENAME']) . '/', strlen(realpath($_SERVER['DOCUMENT_ROOT']))), ' /');
// EOF