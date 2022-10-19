<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Salary;
use PHPUnit\Framework\TestCase;

class SalaryTest extends TestCase
{
    public function testSalaryCreated(): void
    {
        $salary = new Salary(25.50, 27.20, 'EUR', 'hour', true);

        $this->assertEquals(25.50, $salary->getMin());
        $this->assertEquals(27.20, $salary->getMax());
        $this->assertEquals('EUR', $salary->getCurrency());
        $this->assertEquals('hour', $salary->getUnit());
        $this->assertTrue($salary->isVisible());
    }
}
