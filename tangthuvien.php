<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="VN">
    <head>
        <link rel="shortcut icon" href="http://tangthuvien.vn/favicon.ico" type="image/x-icon"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <?php
    error_reporting(1);
    set_time_limit(0);
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    $cPage = 56;
    $ePage = 100;
    $url = 'http://www.tangthuvien.vn/forum/showthread.php?t=94118';

    $dom = new DOMDocument('1.0', 'utf-8');
    $text = '';
    for ($i = $cPage; $i <= $ePage; $i++) {
        $url1 = $url . '&page=' . $i;
        $dom->loadHTMLFile(trim($url1));
        $xpath = new DOMXPath($dom);

        $blogs = $xpath->query(".//div[contains(concat(' ', @id, ' '), ' post_message_')]");
        
        foreach ($blogs as $block) {
            $title = $xpath->query(".//font[@size='5']", $block)->item(0)->nodeValue;
            $content = $xpath->query('.//div[@style="display: none;"]', $block)->item(0)->nodeValue;
            $text .= $title;
            $text .= PHP_EOL;
            $text .= $content;
            $text .= PHP_EOL;
            $text .= $title;
            $text .= PHP_EOL;
            var_dump($title) .'<br/>';
        }
    }

    $fp = fopen('Ao thuat than toa 56 - 100.txt', 'w');
    fwrite($fp, $text);
    fclose($fp);
    ?>
