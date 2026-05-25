<?php
// Load shared config from root config/config.php if available,
// otherwise fall back to local values for standalone use.
$_shared_config = __DIR__ . '/../config/config.php';
if (file_exists($_shared_config)) {
    require_once $_shared_config;
} else {
    $mysqli_host     = "localhost";
    $mysqli_username = "root";
    $mysqli_password = "12345678";
    $mysqli_schema   = "blank";
    $site_name       = "CorePanel";
    $site_email      = "noreply@corepanel.com";
    $site_url        = "../admin";
    $company_name    = "CorePanel";
    $company_url     = "corepanel.com";
    $host_domain     = "localhost";
    $host_key        = "c021d994a66d45363ab679052e0d5915";
}
unset($_shared_config);

$session_pfx = "catmgr_blank3_";

$system_desc = "";

$custom_header = "<table cellspacing='0' cellpadding='0' border='0' style='margin-left:auto; margin-right: auto;padding-top: 5%'>" .
    "<tr><td width='70' valign='middle'><a href='index.php'><img src='logo.png' /></a></td></tr>" .
    "<tr><td valign='middle'><span class='small'>" . $system_desc . "</span></td>" .
    "</table><br>";

$mce_base_url = "/corepanel/";
$mce_src_url  = "/tinymce4.8/";
$lib_base     = "lib/";

$system_address = "";
$system_phone   = "";

$enable_audit = array("");


$version = 1.2;

// ── Dev / UI toggles ─────────────────────────────────────────────────────────
$debug_mode         = 1;  // 1 = show PHP errors on screen (dev only, keep 0 in production)
$disable_rightclick = 0;  // 1 = right-click disabled, 0 = right-click allowed
