<?php

namespace Midstackdev\Press\Fields;

use Midstackdev\Press\MarkdownParser;


class Extra extends FieldContract
{
    public static function process($type, $value, $data)
    {
        $extra = isset($data['extra']) ? (array)json_decode($data['extra']) : [];

        return [
           'extra' => json_encode(array_merge($extra, [
                $type => $value,
           ]))
        ];
    }
}