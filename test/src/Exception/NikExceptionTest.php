<?php
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik\Exception;

use ReflectionClass;
use RuntimeException;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Nik\Exception\NikException;
use Wayang\Stdlib\Nik\Exception\ExceptionInterface;

class NikExceptionTest extends TestCase
{
  public function testMustBeClass(){
    $rc = new ReflectionClass(NikException::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeSubclassOfRuntimeException(){
    $rc = new ReflectionClass(NikException::class);
    $this->assertTrue($rc->isSubclassOf(RuntimeException::class));
  }

  public function testMustBeImplemetsExceptionInterface(){
    $rc = new ReflectionClass(NikException::class);
    $this->assertTrue($rc->implementsInterface(ExceptionInterface::class));
  }
}