<?php

include __DIR__ . "/vendor/autoload.php";

use GameOfLife\SmartGrid;

$grid = new SmartGrid();

$grid->addCell(0,1);
$grid->addCell(1,2);
$grid->addCell(2,2);

$grid->dump(3, 3);

