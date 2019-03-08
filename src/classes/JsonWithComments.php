<?php

/**
 * Creator: Bryan Mayor
 * Company: Blue Nest Digital, LLC
 * License: (Blue Nest Digital LLC, All rights reserved)
 * Copyright: Copyright 2017 Blue Nest Digital LLC
 */

class JsonWithComments {
	static function decode($jsonString, $asArray = true, $trim = true) {
		if($trim) {
			$jsonString = trim($jsonString);
		}

        $lines = explode(PHP_EOL, $jsonString);

        // Get all content lines, skipping comments
        $contentLines = [];
        foreach($lines as $line) {
            $line = trim($line);
            if(strpos($line, "//") === 0) {
                continue;
            }
            $contentLines[] = $line;
        }

        $contentJson = implode(PHP_EOL, $contentLines);

        $decoded = json_decode($contentJson, $asArray);

        if($decoded === null) {
            throw new \RuntimeException("Error parsing environment as json: " . print_r($jsonString, true) . PHP_EOL . "JSON error=" . json_last_error_msg());
        }

        return $decoded;
	}
}