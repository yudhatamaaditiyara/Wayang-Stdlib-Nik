<?php declare(strict_types=1);
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik\Resources;

use DateTimeInterface;
use Wayang\Stdlib\Nik\Birthday;

class InjectNowBirthday extends Birthday
{
  protected $nowDay;
  protected $nowMonth;
  protected $nowYear;

  public function __construct($raw, int $nowDay, int $nowMonth, int $nowYear){
    $this->nowDay = $nowDay;
    $this->nowMonth = $nowMonth;
    $this->nowYear = $nowYear;
    parent::__construct($raw);
  }

  protected function now(): DateTimeInterface{
    return new InjectNowDateTime($this->nowDay, $this->nowMonth, $this->nowYear);
  }
}