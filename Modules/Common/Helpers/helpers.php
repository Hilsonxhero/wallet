<?php


function front_path($path, $param = [], $route = false)
{
    if ($route) {
        $base = $path;
        return $base  . "?" . http_build_query($param);
    } else {
        $base = getenv("FRONT_ENDPOINT");
        return $base . $path . "?" . http_build_query($param);
    }
}


/**
 * @param $text
 * @param $limit
 * @return string
 */
function truncate($text, $limit = 35): ?string
{
    return \Illuminate\Support\Str::limit($text, $limit, ' ...');
}

function base64($file)
{
    if (!preg_match('/^(?:[data]{4}:(text|image|application)\/[a-z]*)/', $file)) {
        return false;
    } else {
        return true;
    }
}

function createDatetimeFromFormat($date, $format = 'Y/m/d H:i')
{
    return \Morilog\Jalali\CalendarUtils::createDatetimeFromFormat($format, $date);
}

function formatGregorian($date, $format = 'Y/m/d H:i')
{
    if ($date)  return \Morilog\Jalali\CalendarUtils::strftime($format, strtotime($date));
    return null;
}
