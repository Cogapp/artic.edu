<?php

if (!function_exists('getBlocksForEditor')) {
    /**
     * Sorts a list of blocks by the order in which they are set in the config.
     */
    function getBlocksForEditor($toUse = [])
    {
        $allBlocks = array_keys(config('twill.block_editor.blocks'));

        // Hide 3D blocks from production until they're ready for production use
        if ( app()->environment('production')) {
            $allBlocks = array_except($allBlocks, ['3d_model', '3d_tour', '3d_embed']);
        }

        return array_intersect($allBlocks, $toUse);
    }
}

// https://stackoverflow.com/questions/2087103/how-to-get-innerhtml-of-domnode
if (!function_exists('innerHTML')) {
    function innerHTML($node) {
        return implode(array_map([$node->ownerDocument,'saveHTML'],
                                 iterator_to_array($node->childNodes)));
    }
}

if (!function_exists('getTitleWithFigureNumber')) {
    function getTitleWithFigureNumber($title) {
        global $_figureCount;

        if (isset($_figureCount) && isset($title)) {
            $dom = new DomDocument();
            $dom->loadHTML('<?xml encoding="utf-8" ?>' . $title, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            // Plain text automatically gets wrapped in p-tag during loadHTML
            $firstChild = $dom->documentElement->firstChild ?? null;

            // Just a failsafe to prevent breaking the page
            if (!isset($firstChild)) {
                return $title;
            }

            $_figureCount++;

            $figAnchor = $dom->createElement('a');
            $figAnchor->setAttribute('href', '#fig-' . $_figureCount);
            $figAnchor->appendChild($dom->createTextNode('Fig. ' . $_figureCount));

            $dom->documentElement->insertBefore($figAnchor, $firstChild);
            $dom->documentElement->insertBefore($dom->createTextNode(': '), $firstChild);

            $title = $dom->saveHTML($dom->documentElement);
        }

        return $title;
    }
}

if (!function_exists('getSubtitleWithFigureNumber')) {
    function getSubtitleWithFigureNumber($subtitle, $title) {
        // If the title isn't set, treat the subtitle like one and add a figure number
        return isset($title) ? $subtitle : getTitleWithFigureNumber($subtitle);
    }
}

