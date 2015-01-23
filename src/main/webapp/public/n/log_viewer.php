<?php
/**
 *
 * @package    Temporary log_viewer.php
 * @author     Rakesh Shrestha
 * @since      23/1/15 4:23 PM
 * @version    1.0
 */

$logPath = '../../data/logs';
$action  = !empty($_REQUEST['action']) ? $_REQUEST['action'] : 'list';
function listFiles($path)
{
    $thelist = null;
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                $thelist .= '<li><a href="?action=print&file=' . $file . '">' . $file . '</a></li>';
            }
        }
        closedir($handle);
    }
    return $thelist;
}

function printFile($file)
{
    global $logPath;
    $filePath = __DIR__ . "/{$logPath}/{$file}";
    if (file_exists($filePath)) {
        return file_get_contents($filePath);

    }
}

if (!empty($_REQUEST['pass']) && $_REQUEST['pass'] == 'h0telclubt3st') {
    switch ($action) {

        case 'print':
            if (!empty($_REQUEST['file'])) {
                $file = $_REQUEST['file'];
                header("Content-disposition: attachment; filename={$file}");
                header('Content-type: text/plain');
                echo printFile($_REQUEST['file']);
            }
            break;

        case 'list':
            echo listFiles($logPath);
            break;

    }
}

