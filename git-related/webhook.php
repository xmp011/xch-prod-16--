<?php
/***
$LOCAL_ROOT         = "/public_html/xchangemarket.com";
$LOCAL_REPO_NAME    = "xch-prod-16--2";
$LOCAL_REPO         = "{$LOCAL_ROOT}/{$LOCAL_REPO_NAME}";
$REMOTE_REPO        = "git@github.com:xmp011/xch-prod-16--.git";
$BRANCH             = "master";

if ( $_POST['payload'] ) {

if( file_exists($LOCAL_REPO) ) {

shell_exec("cd {$LOCAL_REPO} && git pull");

die("done " . mktime());
} else {

shell_exec("cd {$LOCAL_ROOT} && git clone {$REMOTE_REPO}");

die("done " . mktime());
}
}
***/
?>