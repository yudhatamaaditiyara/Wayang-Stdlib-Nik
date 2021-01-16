<?php
/**
 * Copyright 2021 Yudha Tama Aditiyara
 * SPDX-License-Identifier: Apache-2.0
 */
namespace WayangTest\Stdlib\Nik\Resources;

use DateTimeImmutable;

class InjectNowDateTime extends DateTimeImmutable
{
  protected $nowDay;
  protected $nowMonth;
  protected $nowYear;

  public function __construct(int $nowDay, int $nowMonth, int $nowYear){
    parent::__construct();
    $this->nowDay = sprintf('%02d', $nowDay);
    $this->nowMonth = sprintf('%02d', $nowMonth);
    $this->nowYear = sprintf('%04d', $nowYear);
  }

  public function format($format): string{
    switch ($format){
      case 'Y':
        return $this->nowYear;
      case 'n':
        return (int)$this->nowMonth;
      case 'j':
        return (int)$this->nowDay;
    }
    return parent::format($format);
  }
}