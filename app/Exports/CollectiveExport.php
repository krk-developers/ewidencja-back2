<?php

declare(strict_types = 1);

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class CollectiveExport implements FromArray, ShouldAutoSize, WithStrictNullComparison
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function array(): array
    {
        return $this->data;
    }
}