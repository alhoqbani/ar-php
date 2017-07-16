<?php

namespace ArUtil;

use ArUtil\Text\QueryBuilder;
use ArUtil\Time\ArDateTime;

class ArUtil
{
    public static function date()
    {
        return new ArDateTime;
    }
    
    public static function query()
    {
        return new QueryBuilder;
    }
}
