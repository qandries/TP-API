<?php

class Newton
{
    static public $base_url = 'https://newton.now.sh/derive/ln%285x%2B3%29';

    function __construct()
    {
        $this->data = file_get_contents(self::$base_url);
    }

    function getdata()
    {
        foreach ($this->fromJson() as $name_string => $data_string)
        {
            $data_line = $data_string;
            echo ($name_string . " : " . $data_string . "\n");

        }
        return $data_line;
    }

    function fromJson()
    {
        $datadecode = json_decode($this->data);
        return $datadecode;

    }
}