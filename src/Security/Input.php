<?php

namespace App\Security;

class Input
{
    public static function string(array $source, string $key, int $maxLength = 255): string
    {
        $value = trim((string) ($source[$key] ?? ''));
        if ($value === '') {
            return '';
        }

        if (mb_strlen($value) > $maxLength) {
            $value = mb_substr($value, 0, $maxLength);
        }

        return $value;
    }

    public static function int(array $source, string $key, int $default = 0): int
    {
        $value = filter_var($source[$key] ?? null, FILTER_VALIDATE_INT);
        if ($value === false || $value === null) {
            return $default;
        }

        return $value;
    }

    public static function float(array $source, string $key, float $default = 0.0): float
    {
        $value = filter_var($source[$key] ?? null, FILTER_VALIDATE_FLOAT);
        if ($value === false || $value === null) {
            return $default;
        }

        return (float) $value;
    }

    public static function email(array $source, string $key): string
    {
        $email = trim((string) ($source[$key] ?? ''));
        if ($email === '') {
            return '';
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
    }

    public static function oneOf(string $value, array $allowed): bool
    {
        return in_array($value, $allowed, true);
    }
}
