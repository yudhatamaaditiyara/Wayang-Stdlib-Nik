<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\StringableInterface;
use Wayang\Stdlib\Nik\NikInterface;

class NikInterfaceTest extends TestCase
{
  public function testMustBeInterface(){
    $rc = new ReflectionClass(NikInterface::class);
    $this->assertTrue($rc->isInterface());
  }

  public function testMustBeSubclassOfStringableInterface(){
    $rc = new ReflectionClass(NikInterface::class);
    $this->assertTrue($rc->isSubclassOf(StringableInterface::class));
  }
}