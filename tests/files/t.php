<?php
/* 
$f = fopen("TEMPLATE", "w+");

for ($i = 0; $i < 50; $i++) {
    fwrite($f, sprintf('WRITING TO LINE %s%s', $i, PHP_EOL));
} */

copy(__DIR__."/TEMPLATE", __DIR__."/TEST_FILE");