<?php

namespace PHPMaker2021\project4sikdec;

/**
 * Crosstab column class
 */
class CrosstabColumn
{
    public $Caption;
    public $Value;
    public $Visible;

    public function __construct($value, $caption, $visible = true)
    {
        $this->Caption = $caption;
        $this->Value = $value;
        $this->Visible = $visible;
    }
}
