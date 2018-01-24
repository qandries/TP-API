<?php

class YWeather
{
    static public $base_url='https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22lyon%2C%20fr%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
    public $data = array();

    function __construct()
    {
        $this->data = file_get_contents(self::$base_url);
    }

    function getInfo()
    {
        //these foreach allows us to reach the data we want
        foreach ($this->fromJson() as $query) {
            foreach ($query as $key_name => $result) {
                if ($key_name == "results") {
                    foreach ($result as $channel) {
                        foreach ($channel as $subkey => $sub_result) {
                            if ($subkey == "item") {
                                foreach ($sub_result as $sub_subkey => $sub_subresult) {
                                    if ($sub_subkey == "description") {
                                        //echo($sub_subkey . " : " . $sub_subresult . "\n");
                                        // Creation of the php file : description weather
                                        $description = $sub_subresult;
                                        fwrite(fopen("index.php", "w"), $description);
                                        //$weather = fopen("index.php","r");
                                        //echo fread($weather, filesize('index.php'));
                                    }
                                    elseif ($sub_subkey == "condition") {
                                        foreach ($sub_subresult as $key_title_name => $definitely_final_result) {
                                            echo($key_title_name . " : " . $definitely_final_result . "\n");
                                        }
                                        echo "\n";
                                    }
                                    elseif ($sub_subkey == "forecast") {
                                        foreach ($sub_subresult as $value) {
                                            foreach ($value as $key_title_name => $definitely_final_result) {
                                                echo($key_title_name . " : " . $definitely_final_result . "\n");
                                            }
                                            echo "\n";
                                        }
                                    }
                                    elseif ($sub_subkey == "title" || $sub_subkey == "link") {
                                        echo($sub_subkey . " : " . $sub_subresult . "\n\n");
                                    }
                                }
                            }
                            elseif ($subkey == "title" || $subkey == "link") {
                                echo ($sub_result . "\n");
                            }
                            elseif (gettype($sub_result) == "array" || gettype($sub_result) == "object") {
                                foreach ($sub_result as $title_name => $final_result) {
                                    echo($title_name . " : " . $final_result . "\n");
                                }
                            }
                            echo "\n";
                        }
                    }
                }
            }
        }
        return $sub_subresult;
    }


    function fromJson()
    {
        $data_decode = json_decode($this->data);
        return $data_decode;

    }
}
