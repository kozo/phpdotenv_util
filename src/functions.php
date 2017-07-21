<?php

function envb($key, $default = null)
{
    $val = getenv($key);
    if ($val === false) {
        return $default;
    }

    if ($val != 'true' && $val != 'false') {
        return $default;
    }

    if ($val == 'true') {
        return true;
    } else {
        return false;
    }
}

function enva($key, $default = null)
{
    $val = getenv($key);
    if ($val === false) {
        return $default;
    }

    $list = explode(',', $val);
    foreach($list as $key=>$val)
    {
        $list[$key] = trim($val);
    }

    return $list;
}
