<?php

namespace PhaelFP\CnpjValidator\Tests;

use PHPUnit\Framework\TestCase;
use PhaelFP\CnpjValidator\Cnpj;

class CnpjTest extends TestCase
{
  public function testCalculateNumericCnpj()
  {
    $this->assertEquals(
      '11444777000161',
      Cnpj::calculate('114447770001')
    );
  }

  public function testValidateValidNumericCnpj()
  {
    $this->assertTrue(
      Cnpj::validate('11444777000161')
    );
  }

  public function testValidateInvalidNumericCnpj()
  {
    $this->assertFalse(
      Cnpj::validate('11444777000100')
    );
  }

  public function testCalculateAlphanumericCnpj()
  {
    $base = '12ABC34501DE';
    $cnpj = Cnpj::calculate($base);

    $this->assertEquals(14, strlen($cnpj));
    $this->assertTrue(Cnpj::validate($cnpj));
  }

  public function testFormatCnpj()
  {
    $this->assertEquals(
      '11.444.777/0001-61',
      Cnpj::format('11444777000161')
    );
  }
}
