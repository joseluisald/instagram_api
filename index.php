<?php
require __DIR__.'/vendor/autoload.php';

$insta = new \Instagram_api\Instagram();

if($insta->getError())
{
    var_dump($insta->getError());
}
else
{
    var_dump($insta->getMedias());
}