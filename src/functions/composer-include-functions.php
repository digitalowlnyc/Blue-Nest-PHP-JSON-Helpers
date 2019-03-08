<?php

	foreach(glob(__DIR__ . "/*.php") as $filename) {
		echo "Including: " . $filename . PHP_EOL;
		if($filename === __FILE__) {
			continue;
		}
    	require $filename;
	}