<?php

namespace Midstackdev\Press\Fields;

use Midstackdev\Press\MarkdownParser;


class Body extends FieldContract
{
    public static function process($type, $value, $data)
    {
        return [
            $type => MarkdownParser::parse($value)
        ];
    }
}