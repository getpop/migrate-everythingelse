<?php

// This is needed to set header Content-type: application/json when doing ?output=json
// IMPORTANT: We can't call doingJson yet, since it would generate $vars before $wp_query is available
// Then, as a hack, simply re-construct the logic of this function
// if (doingJson()) {
if (
	$_REQUEST[GD_URLPARAM_OUTPUT] == GD_URLPARAM_OUTPUT_JSON ||
	$_REQUEST[GD_URLPARAM_SCHEME] == POP_SCHEME_API
	) {
    define('JSON_REQUEST', true);
}