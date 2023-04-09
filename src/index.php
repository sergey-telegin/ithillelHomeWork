<?php
$ds = DIRECTORY_SEPARATOR;
$dir = __DIR__;

require_once $dir . $ds . '..' . $ds . 'src' . $ds . 'base' . $ds . 'reader.php';

$path = "$dir{$ds}..{$ds}";

$urlList = read($path);

echo formatHTML($urlList);


function formatHTML($items)
{
    $html = '<ul>';

    foreach ($items as $item) {
        if (isset($item['items'])) {
            $html .= formatHTML($item['items']);
        } else {
            $html .= sprintf('<li><a href="%s">%s</a></li>', $item['url'], $item['name']);
        }
    }
    $html .= '</ul>';
    return $html;
}