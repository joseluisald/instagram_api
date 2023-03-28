<?php
require __DIR__.'/Instagram.php';

$insta = new Instagram();

if($insta->getError())
{
    var_dump($insta->getError());
}
else
{
    var_dump($insta->getMedias());
}