<?php

namespace Slowlyo\OwlAdmin\Support\Excel;

use Maatwebsite\Excel\Concerns\{FromQuery, Exportable, WithMapping, WithHeadings, ShouldAutoSize};

class AdminExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $query;

    protected $headings;

    protected $map;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public static function make($query)
    {
        return new self($query);
    }

    public function query()
    {
        return $this->query;
    }

    public function setHeadings($headings)
    {
        $this->headings = $headings;

        return $this;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    public function map($row): array
    {
        return call_user_func($this->map, $row);
    }
}
