<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      
      //Long date indo Format
      if ( ! function_exists('nama_eselon'))
      {
          function nama_eselon($param)
          {
            $arreselon = array(
                '0000000000' => 'KEMENTERIAN PERTANIAN',
                '0100000000' => 'SEKRETARIAT JENDERAL',
                '0200000000' => 'DIREKTORAT JENDERAL PRASARANA DAN SARANA PERTANIAN',
                '0300000000' => 'DIREKTORAT JENDERAL TANAMAN PANGAN',
                '0400000000' => 'DIREKTORAT JENDERAL HORTIKULTURA',
                '0500000000' => 'DIREKTORAT JENDERAL PERKEBUNAN',
                '0600000000' => 'DIREKTORAT JENDERAL PETERNAKAN DAN KESEHATAN HEWAN',
                '0700000000' => 'INSPEKTORAT JENDERAL',
                '0800000000' => 'BADAN PENELITIAN DAN PENGEMBANGAN',
                '0900000000' => 'BADAN PENYULUHAN DAN PENGEMBANGAN SDM PERTANIAN',
                '1000000000' => 'BADAN KETAHANAN PANGAN',
                '1100000000' => 'BADAN KARANTINA PERTANIAN'
            );

            foreach($arreselon as $key => $val){
                if($param == $key){
                  return $val;
                }
            }


          }
      }