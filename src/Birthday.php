<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Nik;

use Throwable;
use DateTimeImmutable;
use DateTimeInterface;

class Birthday implements BirthdayInterface
{
  /**
   * @var string
   */
  protected $raw;

  /**
   * @var int
   */
  protected $day;

  /**
   * @var string
   */
  protected $rawDay;

  /**
   * @var int
   */
  protected $month;

  /**
   * @var string
   */
  protected $rawMonth;

  /**
   * @var int
   */
  protected $year;

  /**
   * @var string
   */
  protected $rawYear;

  /**
   * @var DateTimeInterface
   */
  protected $date;

  /**
   * @var string
   */
  protected static $regExp;

  /**
   * @param string|BirthdayInterface $raw
   */
  public function __construct($raw){
    static::parseRaw((string)$raw);
  }

  /**
   * @return string
   */
  public function getRaw(): string{
    return $this->raw;
  }

  /**
   * @return int
   */
  public function getDay(): int{
    return $this->day;
  }

  /**
   * @return string
   */
  public function getRawDay(): string{
    return $this->rawDay;
  }

  /**
   * @return int
   */
  public function getMonth(): int{
    return $this->month;
  }

  /**
   * @return string
   */
  public function getRawMonth(): string{
    return $this->rawMonth;
  }

  /**
   * @return int
   */
  public function getYear(): int{
    return $this->year;
  }

  /**
   * @return string
   */
  public function getRawYear(): string{
    return $this->rawYear;
  }

  /**
   * @return DateTimeInterface
   */
  public function getDate(): DateTimeInterface{
    return $this->date;
  }

  /**
   * @return bool
   */
  public function isFemale(): bool{
    return $this->day > 40;
  }

  /**
   * @return string
   */
  public function __toString(): string{
    return $this->getRaw();
  }

  /**
   * @param string $raw
   * @throws Exception\NikException
   * @return BirthdayInterface
   */
  protected function parseRaw(string $raw): BirthdayInterface{
    $match = [];
    $regExp = static::getRegExp();
    if (!preg_match($regExp, $raw, $match)) {
      throw new Exception\NikException('Invalid NIK(birthday)');
    }
    $this->raw = $match[0];
    $this->day = (int)$match[1];
    $this->rawDay = $match[1];
    $this->month = (int)$match[2];
    $this->rawMonth = $match[2];
    $this->year = (int)$match[3];
    $this->rawYear = $match[3];
    $this->date = $this->createDate($this->day, $this->month, $this->year);
    return $this;
  }

  /**
   * @param int $day
   * @param int $month
   * @param int $year2d
   * @throws Exception\NikException
   * @return DateTimeInterface
   */
  protected function createDate(int $day, int $month, int $year2d): DateTimeInterface{
    $day = $day > 40 ? $day - 40 : $day;
    $year = $this->convertYear($day, $month, $year2d);
    $value = sprintf('%04d-%02d-%02d', $year, $month, $day);
    try {
      $dateTime = new DateTimeImmutable($value);
    } catch (Throwable $e) {
      throw new Exception\NikException('Invalid NIK(birthday)');
    }
    if ($dateTime->format('Y-m-d') !== $value) {
      throw new Exception\NikException('Invalid NIK(birthday)');
    }
    return $dateTime;
  }

  /**
   * @param int $day
   * @param int $month
   * @param int $year2d
   * @return int
   */
  protected function convertYear(int $day, int $month, int $year2d): int{
    $now = $this->now();
    $nowYear = (int)$now->format('Y') % 10000;
    $year = ~~($nowYear / 100) * 100 + $year2d;
    if ($year < $nowYear) {
      return $year;
    }
    $offset = $year < 100 ? -9900 : 100;
    if ($year > $nowYear) {
      return $year - $offset;
    }
    $nowMonth = (int)$now->format('n');
    if ($month < $nowMonth) {
      return $year;
    }
    if ($month > $nowMonth) {
      return $year - $offset;
    }
    $nowDay = (int)$now->format('j');
    if ($day > $nowDay) {
      return $year - $offset;
    }
    return $year;
  }

  /**
   * @return DateTimeInterface
   */
  protected function now(): DateTimeInterface{
    return new DateTimeImmutable();
  }

  /**
   * @param string|BirthdayInterface $raw
   * @return BirthdayInterface
   */
  public static function parse($raw): BirthdayInterface{
    return new static($raw);
  }

  /**
   * @return string
   */
  protected static function getRegExp(): string{
    if (static::$regExp !== null) {
      return static::$regExp;
    }
    $re1 = '(?:[0-9]{2})';
    $re2 = '(?:0[1-9]|[1-9][0-9])';
    static::$regExp = "/^({$re2})({$re2})({$re1})\$/";
    return static::$regExp;
  }
}