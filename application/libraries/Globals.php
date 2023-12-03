<?php
class Globals
{

    public function __construct($config = array())
    {
        foreach ($config as $key => $value) {
            $data[$key] = $value;
        }

        $CI = &get_instance();

        $CI->load->vars($data);
    }
}
