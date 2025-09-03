<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Random String function
 * Membuat fungsi random untuk kode 
 *
 * @author    Asyhadi, Pusdatin Kementan
 * 
 */

 class Random{

        function randomString($length)
        {
            $str        = "";
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
            $max        = strlen($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            return $str;
        }

 }




