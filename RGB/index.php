<?php

class RGB
{
    private $color; //#ff0000
    private $red;
    private $green;
    private $blue;

    public function __construct($colorCode)
    {
        $this->color = ltrim($colorCode, "#");
        $this->parseColor();
    }
    public function getColor()
    {
        return $this->color;
    }
    public function readRGBColor()
    {
        echo "Red: {$this->red}\nGreen: {$this->green}\nBlue: {$this->blue}\n";
    }
    public function getRGBColor()
    {
        return array($this->red, $this->green, $this->blue);
    }

    private function parseColor()
    {
        if ($this->color) {
            list($this->red, $this->green, $this->blue) = sscanf($this->color, "%02x%02x%02x");
        } else {
            list($this->red, $this->green, $this->blue) = array(0, 0, 0);
        }
    }
    public function getRed()
    {
        return $this->red;
    }
    public function getGreen()
    {
        return $this->green;
    }
    public function getBlue()
    {
        return $this->blue;
    }
}

$obj = new RGB('#ff00ff');
$obj->readRGBColor();

// echo $obj->getGreen();
