<?php
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik;

use Throwable;
use ReflectionClass;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Wayang\Stdlib\Nik\Birthday;
use Wayang\Stdlib\Nik\BirthdayInterface;
use Wayang\Stdlib\Nik\Exception\NikException;

class BirthdayTest extends TestCase
{
  const MALE_BIRTHDAY = '010203';
  const FEMALE_BIRTHDAY = '410203';
  const INVALID_BIRTHDAY = '000102';
  const INVALID_MALE_DAY_BIRTHDAY = '320203';
  const INVALID_MALE_MONTH_BIRTHDAY = '011303';
  const INVALID_FEMALE_DAY_BIRTHDAY = '720203';
  const INVALID_FEMALE_MONTH_BIRTHDAY = '411303';
  const INVALID_MALE_OFFSET_DAY_BIRTHDAY = '310203';
  const INVALID_FEMALE_OFFSET_DAY_BIRTHDAY = '710203';

  public function testMustBeClass(){
    $rc = new ReflectionClass(Birthday::class);
    $this->assertFalse($rc->isTrait());
    $this->assertFalse($rc->isInterface());
  }

  public function testMustBeImplemetsBirthdayInterface(){
    $rc = new ReflectionClass(Birthday::class);
    $this->assertTrue($rc->implementsInterface(BirthdayInterface::class));
  }

  public function testMaleBirthday(){
    $birthday = Birthday::parse(static::MALE_BIRTHDAY);
    $this->assertEquals($birthday->getRaw(), static::MALE_BIRTHDAY);
    $this->assertEquals($birthday->getDay(), 1);
    $this->assertEquals($birthday->getRawDay(), '01');
    $this->assertEquals($birthday->getMonth(), 2);
    $this->assertEquals($birthday->getRawMonth(), '02');
    $this->assertEquals($birthday->getYear(), 3);
    $this->assertEquals($birthday->getRawYear(), '03');
    $this->assertInstanceOf(DateTimeImmutable::class, $birthday->getDate());
    $this->assertInstanceOf(DateTimeInterface::class, $birthday->getDate());
    $this->assertEquals($birthday->getDate()->format('dmy'), '010203');
    $this->assertFalse($birthday->isFemale());
    $this->assertEquals((string)$birthday, static::MALE_BIRTHDAY);
  }

  public function testFemaleBirthday(){
    $birthday = Birthday::parse(static::FEMALE_BIRTHDAY);
    $this->assertEquals($birthday->getRaw(), static::FEMALE_BIRTHDAY);
    $this->assertEquals($birthday->getDay(), 41);
    $this->assertEquals($birthday->getRawDay(), '41');
    $this->assertEquals($birthday->getMonth(), 2);
    $this->assertEquals($birthday->getRawMonth(), '02');
    $this->assertEquals($birthday->getYear(), 3);
    $this->assertEquals($birthday->getRawYear(), '03');
    $this->assertInstanceOf(DateTimeImmutable::class, $birthday->getDate());
    $this->assertInstanceOf(DateTimeInterface::class, $birthday->getDate());
    $this->assertEquals($birthday->getDate()->format('dmy'), '010203');
    $this->assertTrue($birthday->isFemale());
    $this->assertEquals((string)$birthday, static::FEMALE_BIRTHDAY);
  }

  public function testInvalidBirthday(){
    try {
      Birthday::parse(static::INVALID_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidMaleDayBirthday(){
    try {
      Birthday::parse(static::INVALID_MALE_DAY_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidMaleMonthBirthday(){
    try {
      Birthday::parse(static::INVALID_MALE_MONTH_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidFemaleDayBirthday(){
    try {
      Birthday::parse(static::INVALID_FEMALE_DAY_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidFemaleMonthBirthday(){
    try {
      Birthday::parse(static::INVALID_FEMALE_MONTH_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidMaleOffsetDayBirthday(){
    try {
      Birthday::parse(static::INVALID_MALE_OFFSET_DAY_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testInvalidFemaleOffsetDayBirthday(){
    try {
      Birthday::parse(static::INVALID_FEMALE_OFFSET_DAY_BIRTHDAY);
    } catch (Throwable $e) {
      $this->assertTrue($e instanceof NikException);
      return;
    }
    $this->assertTrue(false);
  }

  public function testWhenYearLessThanNowYear(){
    $birthday = new Resources\InjectNowBirthday('010200', 1, 2, 1);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-02-0000');
  }

  public function testWhenYearGreaterThanNowYear(){
    $birthday = new Resources\InjectNowBirthday('010202', 1, 2, 1);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-02-9902');
  }

  public function testWhenMonthLessThanNowMonth(){
    $birthday = new Resources\InjectNowBirthday('010100', 1, 2, 0);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-01-0000');
  }

  public function testWhenMonthGreaterThanNowMonth(){
    $birthday = new Resources\InjectNowBirthday('010300', 1, 2, 0);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-03-9900');
  }

  public function testWhenDayLessThanNowDay(){
    $birthday = new Resources\InjectNowBirthday('010200', 2, 2, 0);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-02-0000');
  }

  public function testWhenDayGreaterThanNowDay(){
    $birthday = new Resources\InjectNowBirthday('030200', 2, 2, 0);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '03-02-9900');
  }

  public function testWhenDayEqualsNowDay(){
    $birthday = new Resources\InjectNowBirthday('010200', 1, 2, 0);
    $this->assertEquals($birthday->getDate()->format('d-m-Y'), '01-02-0000');
  }

  public function testWhenNowYear0000(){
    $birthday1 = new Resources\InjectNowBirthday('010200', 1, 2, 0);
    $birthday2 = new Resources\InjectNowBirthday('010201', 1, 2, 0);
    $this->assertEquals($birthday1->getDate()->format('d-m-Y'), '01-02-0000');
    $this->assertEquals($birthday2->getDate()->format('d-m-Y'), '01-02-9901');
  }

  public function testWhenNowYear9999(){
    $birthday1 = new Resources\InjectNowBirthday('010200', 1, 2, 9999);
    $birthday2 = new Resources\InjectNowBirthday('010299', 1, 2, 9999);
    $this->assertEquals($birthday1->getDate()->format('d-m-Y'), '01-02-9900');
    $this->assertEquals($birthday2->getDate()->format('d-m-Y'), '01-02-9999');
  }

  public function testWhenNowYear0050(){
    $birthday1 = new Resources\InjectNowBirthday('010249', 1, 2, 50);
    $birthday2 = new Resources\InjectNowBirthday('010250', 1, 2, 50);
    $birthday3 = new Resources\InjectNowBirthday('010251', 1, 2, 50);
    $this->assertEquals($birthday1->getDate()->format('d-m-Y'), '01-02-0049');
    $this->assertEquals($birthday2->getDate()->format('d-m-Y'), '01-02-0050');
    $this->assertEquals($birthday3->getDate()->format('d-m-Y'), '01-02-9951');
  }

  public function testWhenNowYear10050(){
    $birthday1 = new Resources\InjectNowBirthday('010249', 1, 2, 10050);
    $birthday2 = new Resources\InjectNowBirthday('010250', 1, 2, 10050);
    $birthday3 = new Resources\InjectNowBirthday('010251', 1, 2, 10050);
    $this->assertEquals($birthday1->getDate()->format('d-m-Y'), '01-02-0049');
    $this->assertEquals($birthday2->getDate()->format('d-m-Y'), '01-02-0050');
    $this->assertEquals($birthday3->getDate()->format('d-m-Y'), '01-02-9951');
  }
}