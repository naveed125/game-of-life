<?php

include __DIR__ . "/vendor/autoload.php";

use GameOfLife\SmartGrid;

$grid = new SmartGrid();

$grid->addCell(1,1);
$grid->addCell(1,2);
$grid->addCell(2,2);

$steps = 4;
if(isset($argv[1])) {
    $steps = $argv[1];
}

echo "Initial State:\n";
$grid->dump(4, 4);
for($i=0; $i<$steps; $i++) {
    $grid->step();
    echo "Step " . ($i+1) . ":\n";
    $grid->dump(4, 4);
}

