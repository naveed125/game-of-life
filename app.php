<?php

include __DIR__ . "/vendor/autoload.php";

use GameOfLife\SmartGrid;

$grid = new SmartGrid();

$grid->addCell(1,1);
$grid->addCell(1,2);
$grid->addCell(1,3);

$grid->dump(4, 4);
$grid->step();

$grid->dump(4, 4);
$grid->step();

$grid->dump(4, 4);
$grid->step();

$grid->dump(4, 4);
$grid->step();

$grid->dump(4, 4);
$grid->step();


