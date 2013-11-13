=== MetaTager ===

This snippet outputs meta tags: title, description, keywords, base, link[canonical] and favicon. It tries to fill all the fields by known data, and do this maximum fast.

Title output logic: "specific_title (TV)" or "longtitle - sitename" or "pagetitle - sitename"

Keywords output logic: "keywords (TV)" or "pagetitle"

Description output logic: "description" or "introtext" or title from above

default config = array(
	'id' => $modx->resource->get('id'),
	'context' => $modx->context->key,
	'keywords' => "",
	'kwTVname' => "keywords", // keywords stored in TV
	'favicon_path' => "/favicon.ico",
	'spec_titleTVname' => "specific_title",
	'scheme' => "full", // syntax of modX.makeUrl
	'minify' => '0',
	'debug' => '0'
);
