<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace Wayang\Stdlib\Nik;

use DateTimeInterface;
use Wayang\Stdlib\StringableInterface;

interface BirthdayInterface extends StringableInterface
{
  /**
   * @return string
   */
  public function getRaw(): string;

  /**
   * @return int
   */
  public function getDay(): int;

  /**
   * @return string
   */
  public function getRawDay(): string;

  /**
   * @return int
   */
  public function getMonth(): int;

  /**
   * @return string
   */
  public function getRawMonth(): string;

  /**
   * @return int
   */
  public function getYear(): int;

  /**
   * @return string
   */
  public function getRawYear(): string;

  /**
   * @return DateTimeInterface
   */
  public function getDate(): DateTimeInterface;

  /**
   * @return bool
   */
  public function isFemale(): bool;
}