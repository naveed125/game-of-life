<?php

namespace GameOfLife;

class SmartGrid {

    /**
     * @var array
     */
    private $items = null;

    /**
     * SmartGrid constructor
     */
    public function __construct()
    {
        $this->items = [];
    }
    
    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    public function dump($X, $Y)
    {
        for($i=0; $i<=$X; $i++)
        {
            for ($j = 0; $j <= $Y; $j++)
            {
                if($this->hasCell($i, $j)) {
                    echo "#";
                }
                else {
                    echo "0";
                }
            }

            echo PHP_EOL;
        }

        echo "--\n";
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function hasCell($x, $y) {
        return isset($this->items["{$x}.{$y}"]);
    }

    /**
     * @param $x
     * @param $y
     * @return mixed
     */
    public function getCell($x, $y)
    {
        return $this->items["{$x}.{$y}"];
    }

    /**
     * @param $x
     * @param $y
     * @param int $value
     */
    public function addCell($x, $y, $value = 1)
    {
        if($x < 0 || $y < 0)
        {
            throw new \InvalidArgumentException("x and y must be greater than zero");
        }

        $this->items["{$x}.{$y}"] = $value;
    }

    /**
     * @param $x
     * @param $y
     */
    public function removeCell($x, $y)
    {
        unset($this->items["{$x}.{$y}"]);
    }

    /**
     * @param $x
     * @param $y
     * @return array
     */
    public function getNeighbors($x, $y, $skipDead = true)
    {
        $neighbors = [];
        for($i=-1; $i<=1; $i++)
        {
            for($j=-1; $j<=1; $j++)
            {
                $nx = $x + $i;
                $ny = $y + $j;
                if(!($nx == $x && $ny == $y) && ($nx > -1 && $ny > -1))
                {
                    if($this->hasCell($nx, $ny)) {
                        $neighbors["{$nx}.{$ny}"] = $this->getCell($nx, $ny);
                    }
                    else {
                        if(!$skipDead) {
                            $neighbors["{$nx}.{$ny}"] = 0;
                        }
                    }
                }
            }
        }

        return $neighbors;
    }

    public function step() {

        // use neighbors of live cells to identify potentials
        $potentials = [];
        foreach(array_keys($this->items) as $key) {
            list($x, $y) = explode(".", $key);
            $neighbors = $this->getNeighbors($x, $y, false);
            $potentials = array_merge($potentials, $neighbors);
        }

        // process the potentials for any changed
        $commands = [];
        foreach($potentials as $key=>$value) {
            list($x, $y) = explode(".", $key);
            $neighbors = $this->getNeighbors($x, $y);

            // a dead cell becomes alive if it has exactly 3 neighbors
            if( ! $this->hasCell($x, $y)) {
                if(count($neighbors) == 3) {
                    $commands[] = ['addCell', $x, $y];
                }
            }
            else {
                // alive cell dies if it has less than 2 or more than 3
                if(count($neighbors) < 2 || count($neighbors) > 3) {
                    $commands[] = ['removeCell', $x, $y];
                }
            }
        }

        foreach ($commands as $command) {
            call_user_func([$this, $command[0]], $command[1], $command[2]);
        }

    }
}
