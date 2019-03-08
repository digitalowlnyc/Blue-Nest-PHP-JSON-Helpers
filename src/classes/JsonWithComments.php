<?php

/**
 * Creator: Bryan Mayor
 * Company: Blue Nest Digital, LLC
 * License: (Blue Nest Digital LLC, All rights reserved)
 * Copyright: Copyright 2017 Blue Nest Digital LLC
 */

class JsonWithComments {
	static function decode($jsonString, $asArray = true, $trim = true, $removeTrailingCommas = true) {
		if($trim) {
			$jsonString = trim($jsonString);
		}

        $lines = explode(PHP_EOL, $jsonString);

        // Get all content lines, removing comments
        $contentLines = [];
        $comments = [];
        foreach($lines as $line) {
            if(preg_match("#(.?)\/\/(.+)#", $line, $matches)) {
            	$comments[] = $matches[2];
            	$line = $matches[1];
			}
            $contentLines[] = $line;
        }
        
        $contentJson = implode(PHP_EOL, $contentLines);

		if($removeTrailingCommas) {
    	    $contentJson = preg_replace("#,\s+\}#", "}", $contentJson);
		}
        $decoded = json_decode($contentJson, $asArray);

        if($decoded === null) {
            throw new \RuntimeException("Error parsing environment as json: " . print_r($jsonString, true) . PHP_EOL . "JSON error=" . json_last_error_msg());
        }

        return $decoded;
	}
}