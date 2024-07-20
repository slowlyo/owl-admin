<?php

namespace Slowlyo\OwlAdmin\Exceptions;

use Slowlyo\OwlAdmin\Admin;

class AdminException extends \Exception
{
    private $data;
    private $doNotDisplayToast;

    public function __construct($message = "", $data = [], $doNotDisplayToast = 0)
    {
        parent::__construct($message);

        $this->data              = $data;
        $this->doNotDisplayToast = $doNotDisplayToast;
    }

    public function render()
    {
        return Admin::response()->doNotDisplayToast($this->doNotDisplayToast)->fail($this->getMessage(), $this->data);
    }

    public function report()
    {
        // not report
    }
}
