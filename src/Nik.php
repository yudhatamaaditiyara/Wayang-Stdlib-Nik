<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Nik;

class Nik implements NikInterface
{
  /**
   * @var string
   */
  protected $raw;

  /**
   * @var int
   */
  protected $province;

  /**
   * @var string
   */
  protected $rawProvince;

  /**
   * @var int
   */
  protected $regency;

  /**
   * @var string
   */
  protected $rawRegency;

  /**
   * @var int
   */
  protected $district;

  /**
   * @var string
   */
  protected $rawDistrict;

  /**
   * @var BirthdayInterface
   */
  protected $birthday;

  /**
   * @var int
   */
  protected $sequence;

  /**
   * @var string
   */
  protected $rawSequence;

  /**
   * @var string
   */
  protected static $regExp;

  /**
   * @param string|NikInterface $raw
   */
  public function __construct($raw){
    $this->parseRaw((string)$raw);
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
  public function getProvince(): int{
    return $this->province;
  }
  
  /**
   * @return string
   */
  public function getRawProvince(): string{
    return $this->rawProvince;
  }

  /**
   * @return int
   */
  public function getRegency(): int{
    return $this->regency;
  }

  /**
   * @return string
   */
  public function getRawRegency(): string{
    return $this->rawRegency;
  }

  /**
   * @return int
   */
  public function getDistrict(): int{
    return $this->district;
  }

  /**
   * @return string
   */
  public function getRawDistrict(): string{
    return $this->rawDistrict;
  }

  /**
   * @return BirthdayInterface
   */
  public function getBirthday(): BirthdayInterface{
    return $this->birthday;
  }

  /**
   * @return string
   */
  public function getRawBirthday(): string{
    return $this->birthday->getRaw();
  }

  /**
   * @return int
   */
  public function getSequence(): int{
    return $this->sequence;
  }

  /**
   * @return string
   */
  public function getRawSequence(): string{
    return $this->rawSequence;
  }

  /**
   * @return bool
   */
  public function isFemale(): bool{
    return $this->birthday->isFemale();
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
   * @return NikInterface
   */
  protected function parseRaw(string $raw): NikInterface{
    $match = [];
    $regExp = static::getRegExp();
    if (!preg_match($regExp, $raw, $match)) {
      throw new Exception\NikException('Invalid NIK');
    }
    $this->raw = $match[0];
    $this->province = (int)$match[1];
    $this->rawProvince = $match[1];
    $this->regency = (int)$match[2];
    $this->rawRegency = $match[2];
    $this->district = (int)$match[3];
    $this->rawDistrict = $match[3];
    $this->birthday = $this->createBirthday($match[4]);
    $this->sequence = (int)$match[5];
    $this->rawSequence = $match[5];
    return $this;
  }

  /**
   * @param string $raw
   * @return BirthdayInterface
   */
  protected function createBirthday(string $raw): BirthdayInterface{
    return new Birthday($raw);
  }

  /**
   * @param string|NikInterface $raw
   * @return NikInterface
   */
  public static function parse($raw): NikInterface{
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
    static::$regExp = "/^({$re2})({$re2})({$re2})({$re2}{$re2}{$re1})({$re1}{$re2})\$/";
    return static::$regExp;
  }
}