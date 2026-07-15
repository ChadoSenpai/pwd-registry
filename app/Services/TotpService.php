<?php

namespace App\Services;

class TotpService
{
    public static function generateSecret(int $length = 16): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';

        for ($i = 0; $i < $length; $i++) {
            $secret .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }

        return $secret;
    }

    public static function getTotpUri(string $secret, string $issuer, string $account): string
    {
        return 'otpauth://totp/' . rawurlencode($issuer) . ':' . rawurlencode($account)
            . '?secret=' . $secret
            . '&issuer=' . rawurlencode($issuer)
            . '&algorithm=SHA1&digits=6&period=30';
    }

    public static function verifyCode(string $secret, string $code, int $window = 1): bool
    {
        $secret = strtoupper($secret);
        if (!preg_match('/^[A-Z2-7]+$/', $secret)) {
            return false;
        }

        $code = trim($code);
        if (!preg_match('/^\d{6}$/', $code)) {
            return false;
        }

        $time = time();
        for ($i = -$window; $i <= $window; $i++) {
            if (self::hotp($secret, self::timeSlice($time + $i * 30)) === $code) {
                return true;
            }
        }

        return false;
    }

    private static function timeSlice(int $time): int
    {
        return (int) floor($time / 30);
    }

    private static function hotp(string $secret, int $counter, int $digits = 6): string
    {
        $key = self::base32Decode($secret);
        $counterBytes = pack('N*', 0) . pack('N*', $counter);
        $hash = hash_hmac('sha1', $counterBytes, $key, true);
        $offset = ord($hash[19]) & 0x0F;
        $binary = (ord($hash[$offset]) & 0x7F) << 24 |
            (ord($hash[$offset + 1]) & 0xFF) << 16 |
            (ord($hash[$offset + 2]) & 0xFF) << 8 |
            (ord($hash[$offset + 3]) & 0xFF);
        $otp = $binary % pow(10, $digits);

        return str_pad((string) $otp, $digits, '0', STR_PAD_LEFT);
    }

    private static function base32Decode(string $secret): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = preg_replace('/[^A-Z2-7]/', '', strtoupper($secret));
        $binary = '';

        foreach (str_split($secret) as $char) {
            $value = strpos($alphabet, $char);
            $binary .= str_pad(decbin($value), 5, '0', STR_PAD_LEFT);
        }

        $bytes = '';
        foreach (str_split($binary, 8) as $byte) {
            if (strlen($byte) === 8) {
                $bytes .= chr(bindec($byte));
            }
        }

        return $bytes;
    }
}
