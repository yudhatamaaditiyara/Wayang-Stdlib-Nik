<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Nik;

use Wayang\Stdlib\StringableInterface;

interface NikInterface extends StringableInterface
{
  /**
   * @return string
   */
  public function getRaw(): string;

  /**
   * @return int
   */
  public function getProvince(): int;
  
  /**
   * @return string
   */
  public function getRawProvince(): string;

  /**
   * @return int
   */
  public function getRegency(): int;

  /**
   * @return string
   */
  public function getRawRegency(): string;

  /**
   * @return int
   */
  public function getDistrict(): int;

  /**
   * @return string
   */
  public function getRawDistrict(): string;

  /**
   * @return BirthdayInterface
   */
  public function getBirthday(): BirthdayInterface;

  /**
   * @return string
   */
  public function getRawBirthday(): string;

  /**
   * @return int
   */
  public function getSequence(): int;

  /**
   * @return string
   */
  public function getRawSequence(): string;

  /**
   * @return bool
   */
  public function isFemale(): bool;
}