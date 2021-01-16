<?php
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\StringableInterface;
use Wayang\Stdlib\Nik\BirthdayInterface;

class BirthdayInterfaceTest extends TestCase
{
  public function testMustBeInterface(){
    $rc = new ReflectionClass(BirthdayInterface::class);
    $this->assertTrue($rc->isInterface());
  }

  public function testMustBeSubclassOfStringableInterface(){
    $rc = new ReflectionClass(BirthdayInterface::class);
    $this->assertTrue($rc->isSubclassOf(StringableInterface::class));
  }
}