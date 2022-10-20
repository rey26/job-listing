<?php

namespace App\Entity;

/**
 * This class stores data about salary and belongs to a job
 * @package App\Entity
 */
class Salary
{
    private float $min;
    private float $max;
    private string $currency;
    private string $unit;
    private bool $visible;

    public function __construct(
        float $min,
        float $max,
        string $currency,
        string $unit,
        bool $visible
    ) {
        $this->min = $min;
        $this->max = $max;
        $this->currency = $currency;
        $this->unit = $unit;
        $this->visible = $visible;
    }

    public function getMin(): float
    {
        return $this->min;
    }

    public function getMinWithCurrency(): string
    {
        return $this->min . ' ' . $this->currency;
    }

    public function getMax(): float
    {
        return $this->max;
    }

    public function getMaxWithCurrency(): string
    {
        return $this->max . ' ' . $this->currency;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}
