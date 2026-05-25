<?php
/**
 * config/functions.php
 * Standalone utility library for the public site.
 * Mirrors the reusable functions from admin/lib/common.lib —
 * without any admin session guards, menu, or settings dependencies.
 */

if (!defined('_FUNCTIONS_LOADED')) {
    define('_FUNCTIONS_LOADED', true);

    // Load shared config if not already loaded
    if (!isset($mysqli_host)) {
        require_once __DIR__ . '/config.php';
    }

    // ── Database connection ──────────────────────────────────────────────────
    $db = mysqli_connect($mysqli_host, $mysqli_username, $mysqli_password, $mysqli_schema);
    if (!$db) {
        die('Cannot connect to database.');
    }
    mysqli_set_charset($db, 'utf8');

    // Clear credentials from memory
    $mysqli_host = $mysqli_username = $mysqli_password = $mysqli_schema = '';

    // ── Session ──────────────────────────────────────────────────────────────
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $session_pfx = isset($session_pfx) ? $session_pfx : ($mysqli_schema ?? 'pub_') . '_';

    // ── Language loader ──────────────────────────────────────────────────────
    $_pub_supported = ['en', 'bm', 'zh'];
    if (isset($_GET['setlang']) && in_array($_GET['setlang'], $_pub_supported)) {
        $_SESSION[$session_pfx . 'lang'] = $_GET['setlang'];
    }
    $_pub_lang = (isset($_SESSION[$session_pfx . 'lang']) && in_array($_SESSION[$session_pfx . 'lang'], $_pub_supported))
        ? $_SESSION[$session_pfx . 'lang'] : 'en';
    $LANG = require_once __DIR__ . '/lang/' . $_pub_lang . '.php';
    $lg   = ($_pub_lang === 'en') ? '' : '_' . $_pub_lang;
}

// ============================================================================
// FORM HELPERS
// ============================================================================

/** Safely wrap htmlspecialchars */
function hsc($s) { return htmlspecialchars($s, ENT_QUOTES); }

/** Get POST value, HTML-escaped */
function frmp($s) { return isset($_POST[$s]) ? hsc($_POST[$s]) : ''; }

/** Get GET value, HTML-escaped */
function frmg($s) { return isset($_GET[$s]) ? hsc($_GET[$s]) : ''; }

/** Get POST or GET value, HTML-escaped (POST takes priority) */
function frm($s) {
    if (frmp($s) !== '') return frmp($s);
    if (frmg($s) !== '') return frmg($s);
    return '';
}

/** Get raw (unescaped) POST value */
function frmr($s) { return (isset($_POST[$s]) && $_POST[$s] !== '') ? $_POST[$s] : ''; }

/** Escape string for safe SQL insertion */
function clean($s) { global $db; return mysqli_real_escape_string($db, stripslashes($s)); }

// ============================================================================
// MYSQL SHORTCUTS
// ============================================================================

/** Run a query and return the result */
function mq($s) { global $db; return mysqli_query($db, $s); }

/** Fetch next row as array */
function mfa($s) { return mysqli_fetch_array($s); }

/** Return number of rows in a result */
function mnr($s) { return mysqli_num_rows($s); }

// ============================================================================
// SESSION HELPERS
// ============================================================================

/** Set a prefixed session value */
function set($s, $v) { global $session_pfx; $_SESSION[$session_pfx . $s] = $v; }

/** Get a prefixed session value */
function get($s) {
    global $session_pfx;
    return isset($_SESSION[$session_pfx . $s]) ? $_SESSION[$session_pfx . $s] : '';
}

// ============================================================================
// COOKIE HELPERS
// ============================================================================

/** Set a prefixed cookie (1 year expiry) */
function setc($s, $v) {
    global $session_pfx;
    setcookie($session_pfx . $s, $v, time() + 60 * 60 * 24 * 365);
}

/** Get a prefixed cookie value */
function getc($s) {
    global $session_pfx;
    return isset($_COOKIE[$session_pfx . $s]) ? $_COOKIE[$session_pfx . $s] : '';
}

// ============================================================================
// NAVIGATION / REDIRECT
// ============================================================================

/** Redirect via meta refresh */
function go($u) { echo "<meta http-equiv='REFRESH' content='0; URL=" . $u . "'>"; exit(); }

/** Return the full current page URL */
function pageurl() {
    $https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 's' : '';
    $port  = ($_SERVER['SERVER_PORT'] != '80') ? ':' . $_SERVER['SERVER_PORT'] : '';
    return 'http' . $https . '://' . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

// ============================================================================
// DATE & TIME
// ============================================================================

/** Current datetime as Y-m-d H:i:s */
function now() { return date('Y-m-d H:i:s'); }

/** Format date as d-M-Y (e.g. 25-May-2026) */
function sdf($t) { return date('d-M-Y', strtotime($t)); }

/** Format date+time as d-M-Y, h:i a */
function sdtf($t) { return date('d-M-Y, h:i a', strtotime($t)); }

/** Format date as d-m-Y */
function sdfnm($t) { return date('d-m-Y', strtotime($t)); }

/** Format time as h:i a */
function stf($t) { return date('h:i a', strtotime($t)); }

/** Extract day from date */
function sdfd($t) { return date('d', strtotime($t)); }

/** Extract month (numeric) from date */
function sdfm($t) { return date('m', strtotime($t)); }

/** Extract year from date */
function sdfy($t) { return date('Y', strtotime($t)); }

/**
 * Manipulate a Y-m-d date.
 * e.g. moddate('2026-01-01', '+3 day') => '2026-01-04'
 */
function moddate($s, $v) { return date('Y-m-d', strtotime($v, strtotime($s))); }

// ============================================================================
// NUMBER FORMATTING
// ============================================================================

/** Format as integer string with commas */
function dfi($s) { return (isint($s) && $s !== '') ? number_format(cint($s), 0) : '0'; }

/** Format as decimal string with 2 decimal places */
function dfd($s) { return (isdbl($s) && $s !== '') ? number_format(cdbl($s), 2) : '0.00'; }

// ============================================================================
// VALIDATION
// ============================================================================

/** Allow only alphanumeric + underscore */
function isalphanum($s) { return !preg_match('/[^a-zA-Z0-9_]/', $s); }

/** Valid username: 4–16 alphanumeric chars */
function chk($s) { return (strlen($s) >= 4 && strlen($s) <= 16 && isalphanum($s)); }

/** Valid d-m-Y or d-M-Y date */
function isdate($s) {
    if ($s === '') return 0;
    $r = explode('-', $s);
    if (count($r) !== 3) return 0;
    if (!isint($r[1])) { $r[1] = date('m', strtotime('2020-' . $r[1] . '-01')); }
    return checkdate($r[1], $r[0], $r[2]);
}

/** True if date is null/zero/epoch */
function isnulldate($s) {
    return (!isset($s) || in_array($s, [
        '', '00-00-0000', '0000-00-00',
        '00-00-0000 00:00:00', '0000-00-00 00:00:00',
        '1970-01-01', '1970-01-01 00:00:00',
        '01-01-1970', '01-01-1970 00:00:00',
    ]));
}

/** Validate email format */
function isemail($s) {
    return (bool) preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $s);
}

/** Allow only digits, spaces, parentheses, hyphens */
function isphone($s) { return !preg_match('/[^0-9()\- ]/', $s); }

/** Validate URL (http/https) */
function isurl($s) { return (bool) preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $s); }

/** Allow only digits and commas */
function isint($s) { return !preg_match('/[^0-9,]/', $s); }

/** Allow only digits, commas, and up to one decimal point */
function isdbl($s) { return (!preg_match('/[^0-9.,]/', $s) && substr_count($s, '.') < 2); }

// ============================================================================
// TYPE CASTING
// ============================================================================

/** Cast to integer (strips commas) */
function cint($s) { return isint($s) ? (int) trim(str_replace(',', '', $s)) : 0; }

/** Cast to float (strips commas) */
function cdbl($s) { return isdbl($s) ? (float) trim(str_replace(',', '', $s)) : 0.00; }

/** Cast checkbox/truthy string to 1 or 0 */
function cbx($s) { return ($s === 'on' || $s === '1') ? 1 : 0; }

/** Cast various truthy strings to 1 or 0 */
function cbool($s) {
    $s = strtolower($s);
    return in_array($s, ['y', 'yes', 'true', '1', 'on']) ? 1 : 0;
}

// ============================================================================
// STRING HELPERS
// ============================================================================

/** addslashes shorthand */
function asl($s) { return addslashes($s); }

/** Reverse a d-m-Y date to Y-m-d */
function rvd($s) {
    if ($s === '') return '';
    $r = explode('-', $s);
    if (count($r) !== 3) return '';
    return $r[2] . '-' . $r[1] . '-' . $r[0];
}

/** Left-pad a string to length $l with character $c */
function pad($s, $c, $l) { while (strlen($s) < $l) { $s = $c . $s; } return $s; }

/** Replace all alphanumeric characters with 'x' (mask sensitive strings) */
function xxx($s) { return preg_replace('/[a-zA-Z0-9]/', 'x', $s); }

/** Generate a random lowercase alphanumeric string of length $l */
function rnd($l) {
    $s = 'abcdefghjkmnpqrstuvwxyz0123456789';
    $p = '';
    for ($i = 0; $i < $l; $i++) { $p .= substr($s, rand(0, strlen($s) - 1), 1); }
    return $p;
}

/** Convert newlines to <br/> tags */
function lnbr($s) { return str_replace("\n", '<br/>', $s); }

/** Append an error bullet to an error string */
function epfx($e, $s) { return ($e !== '' ? '<br/>' : '') . '&#149;&nbsp; ' . $s; }

/** Append an update bullet to an update string */
function upfx($u, $s) { return ($u !== '' ? '<br/>' : '') . '&#149;&nbsp; ' . $s; }

// ============================================================================
// LANGUAGE
// ============================================================================

/** Translate a UI string key. Falls back to the key itself if not found. */
function t($key, $fallback = null) {
    global $LANG;
    if (is_array($LANG) && isset($LANG[$key])) return $LANG[$key];
    return $fallback !== null ? $fallback : $key;
}
