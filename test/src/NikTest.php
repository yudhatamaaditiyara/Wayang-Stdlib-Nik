<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik;

use Throwable;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Nik\Nik;
use Wayang\Stdlib\Nik\NikInterface;
use Wayang\Stdlib\Nik\BirthdayInterface;
use Wayang\Stdlib\Nik\Exception\NikException;

class NikTest extends TestCase
{
  const MALE_NIK = '0102030102990001';
  const FEMALE_NIK = '0102034102990001';
  const INVALID_PROVINCE_NIK = '0002030102990001';
  const INVALID_REGENCY_NIK = '0100030102990002';
  const INVALID_DISTRICT_NIK = '0102000102990003';
  const INVALID_SEQUENCE_NIK = '0102030102990000';

  public function testMustBeClass(){
    $rc = new ReflectionClass(Nik::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeImplemetsNikInterface(){
    $rc = new ReflectionClass(Nik::class);
    $this->assertTrue($rc->implementsInterface(NikInterface::class));
  }

  public function testMaleNik(){
    $nik = Nik::parse(static::MALE_NIK);
    $this->assertEquals($nik->getRaw(), static::MALE_NIK);
    $this->assertEquals($nik->getProvince(), 1);
    $this->assertEquals($nik->getRawProvince(), '01');
    $this->assertEquals($nik->getRegency(), 2);
    $this->assertEquals($nik->getRawRegency(), '02');
    $this->assertEquals($nik->getDistrict(), 3);
    $this->assertEquals($nik->getRawDistrict(), '03');
    $this->assertInstanceOf(BirthdayInterface::class, $nik->getBirthday());
    $this->assertEquals($nik->getRawBirthday(), '010299');
    $this->assertEquals($nik->getSequence(), 1);
    $this->assertEquals($nik->getRawSequence(), '0001');
    $this->assertFalse($nik->isFemale());
    $this->assertEquals((string)$nik, static::MALE_NIK);
  }

  public function testFemaleNik(){
    $nik = Nik::parse(static::FEMALE_NIK);
    $this->assertEquals($nik->getRaw(), static::FEMALE_NIK);
    $this->assertEquals($nik->getProvince(), 1);
    $this->assertEquals($nik->getRawProvince(), '01');
    $this->assertEquals($nik->getRegency(), 2);
    $this->assertEquals($nik->getRawRegency(), '02');
    $this->assertEquals($nik->getDistrict(), 3);
    $this->assertEquals($nik->getRawDistrict(), '03');
    $this->assertInstanceOf(BirthdayInterface::class, $nik->getBirthday());
    $this->assertEquals($nik->getRawBirthday(), '410299');
    $this->assertEquals($nik->getSequence(), 1);
    $this->assertEquals($nik->getRawSequence(), '0001');
    $this->assertTrue($nik->isFemale());
    $this->assertEquals((string)$nik, static::FEMALE_NIK);
  }

  public function testInvalidProvinceNik(){
    try {
      Nik::parse(static::INVALID_PROVINCE_NIK);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidRegencyNik(){
    try {
      Nik::parse(static::INVALID_REGENCY_NIK);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidDistrictNik(){
    try {
      Nik::parse(static::INVALID_DISTRICT_NIK);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidSequenceNik(){
    try {
      Nik::parse(static::INVALID_SEQUENCE_NIK);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }
}