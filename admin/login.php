<?php
$page_title = "Sign In";
$sql_table  = "employee";
$login      = 1;
require_once "__config.php";
?>
<?php require_once $lib_base . "header1.lib"; ?>
<?php
$p_flux = array(
    "usr", "Username", "text_20", "reqchk",
    "pwd", "Password", "pwd_20",  "reqchk",
);

if (get("loginfail") == "") { set("loginfail", 0); }
?>
<?php require_once $lib_base . "mergei.lib"; ?>
<?php
require_once $lib_base . "preparam.lib";

if ($submitted) {
    require_once $lib_base . "validation.lib";

    if (get("loginfail") >= 6) { $validated = 0; }

    if ($validated) {
        $sql = "SELECT * FROM " . $sql_table . " WHERE usr='" . clean($p["usr"]) . "'";
        $rs  = mq($sql);
        if ($r = mfa($rs)) {
            if ($r["pwd"] == frmp("hash")) {
                if ($r["active"] == 1) {
                    set("id",              $r["id"]);
                    set("usr",             $r["usr"]);
                    set("name",            $r["name"]);
                    set("designation",     $r["designation"]);
                    set("isadmin",         $r["isadmin"]);
                    set("last_login",      $r["last_login"]);
                    set("current_session", sdtf(now()));
                    if (md5($session_pfx . $r["usr"]) == frmp("hash")) { set("samepass", 1); }
                    set("loginfail", 0);
                    $skey = rnd(32);
                    set("skey", $skey);
                    mq("UPDATE " . $sql_table . " SET last_login='" . now() . "',skey='" . $skey . "' WHERE id='" . get("id") . "'");
                    go("home.php");
                } else {
                    $error .= epfx($error, "Your account is not active.");
                }
            } else {
                $error .= epfx($error, "Invalid username or password.");
                set("loginfail", get("loginfail") + 1);
            }
        } else {
            $error .= epfx($error, "Invalid username or password.");
            set("loginfail", get("loginfail") + 1);
        }
    }
}
?>

<?php require_once $lib_base . "subheader.lib"; ?>

<?php if ($error): ?>
    <div class="noti-error" style="margin-bottom:16px;">
        <i class="fas fa-exclamation-circle" style="margin-top:2px;flex-shrink:0;"></i>
        <div><?= $error ?></div>
    </div>
<?php endif; ?>

<?php if (get("loginfail") < 6): ?>
    <div class="login-field">
        <label for="usr">Username</label>
        <input type="text" id="usr" name="usr" value="<?= $p["usr"] ?>" placeholder="Enter username" autocomplete="username" style="width:100%;">
        <script>document.getElementById('usr').focus();</script>
    </div>
    <div class="login-field">
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd" value="" placeholder="Enter password" autocomplete="current-password" style="width:100%;">
    </div>
    <input type="hidden" id="hash" name="hash" value="">
    <input type="submit" name="submit" value="Sign In" class="login-submit btn"
           onclick="dologin('<?= $session_pfx ?>');" style="width:100%;padding:10px;margin-top:4px;">
<?php else: ?>
    <div class="noti-error">
        <i class="fas fa-lock" style="margin-top:2px;"></i>
        <div><strong>Account locked.</strong><br>Too many failed attempts. Please try again later.</div>
    </div>
<?php endif; ?>

<p style="text-align:center;margin-top:20px;font-size:0.75rem;color:var(--text-light);">
    &copy; <?= date('Y') ?> <?= htmlspecialchars($company_name) ?>
</p>

<?php require_once $lib_base . "subfooter2.lib"; ?>
<?php require_once $lib_base . "forms.lib"; ?>
<?php require_once $lib_base . "footer2.lib"; ?>
