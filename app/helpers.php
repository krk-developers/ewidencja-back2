<?php

declare(strict_types=1);

if (! function_exists('pr')) {
    
    function pr($object): void
    {
        echo '<pre>'; print_r($object); echo '</pre>';
    }

}

if (! function_exists('vd')) {

    function vd($object): void
    {
        echo '<pre>'; var_dump($object); echo '</pre>';
    }

}

