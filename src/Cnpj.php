<?php

namespace PhaelFP\CnpjValidator;

class Cnpj
{
  public static function sanitize(string $cnpj): string
  {
    return strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $cnpj));
  }

  public static function isNumeric(string $cnpj): bool
  {
    return ctype_digit($cnpj);
  }

  private static function charToValue(string $char): int
  {
    if (ctype_digit($char)) {
      return (int) $char;
    }

    return ord($char) - 48;
  }

  private static function calculateDigit(array $chars, array $weights): int
  {
    $sum = 0;

    foreach ($chars as $i => $char) {
      $value = self::charToValue($char);
      $sum += $value * $weights[$i];
    }

    $rest = $sum % 11;

    return ($rest < 2) ? 0 : 11 - $rest;
  }

  public static function calculate(string $base): string
  {
    $base = self::sanitize($base);

    if (strlen($base) !== 12) {
      throw new \InvalidArgumentException("Base do CNPJ deve conter 12 caracteres.");
    }

    $weights1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $digit1 = self::calculateDigit(str_split($base), $weights1);

    $weights2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $charsWithDigit1 = array_merge(str_split($base), [$digit1]);
    $digit2 = self::calculateDigit($charsWithDigit1, $weights2);

    return $base . $digit1 . $digit2;
  }

  public static function validate(string $cnpj): bool
  {
    $cnpj = self::sanitize($cnpj);

    if (strlen($cnpj) !== 14) {
      return false;
    }

    $base = substr($cnpj, 0, 12);
    $expected = self::calculate($base);

    return $cnpj === $expected;
  }

  public static function format(string $cnpj): string
  {
    $cnpj = self::sanitize($cnpj);

    if (strlen($cnpj) !== 14) {
      return $cnpj;
    }

    return substr($cnpj, 0, 2) . '.' .
      substr($cnpj, 2, 3) . '.' .
      substr($cnpj, 5, 3) . '/' .
      substr($cnpj, 8, 4) . '-' .
      substr($cnpj, 12, 2);
  }
}
