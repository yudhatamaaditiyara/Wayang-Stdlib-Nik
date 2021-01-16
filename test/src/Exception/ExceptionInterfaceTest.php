<?php
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik\Exception;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\ThrowableInterface;
use Wayang\Stdlib\Nik\Exception\ExceptionInterface;

class ExceptionInterfaceTest extends TestCase
{
  public function testMustBeInterface(){
    $rc = new ReflectionClass(ExceptionInterface::class);
    $this->assertTrue($rc->isInterface());
  }

  public function testMustBeSubclassOfThrowableInterface(){
    $rc = new ReflectionClass(ExceptionInterface::class);
    $this->assertTrue($rc->isSubclassOf(ThrowableInterface::class));
  }
}