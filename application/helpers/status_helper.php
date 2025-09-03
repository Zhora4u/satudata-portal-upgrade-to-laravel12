<?php

function progres($sess, $sts)
{
    if ($sess == 5 && $sts == 1) {
        return "Data sedang diperiksa walidata";
    } elseif ($sess == 2 && $sts == 1) {
        return "Data perlu diperiksa";
    } elseif ($sess == 5 && $sts == 2) {
        return "Data sedang diperiksa pembina data";
    } elseif ($sess == 2 && $sts == 2) {
        return "Data sedang diperiksa pembina data";
    } elseif ($sess == 4 && $sts == 2) {
        return "Data perlu diperiksa";
    } elseif ($sess == 5 && $sts == 3) {
        return "Menunggu konfirmasi walidata";
    } elseif ($sess == 2 && $sts == 3) {
        return "Perlu konfirmasi untuk publish";
    } elseif ($sess == 4 && $sts == 3) {
        return "Menunggu konfirmasi walidata";
    } elseif ($sess == 5 && $sts == 4) {
        return "Data perlu diperbaiki";
    } elseif ($sess == 2 && $sts == 4) {
        return "Data sedang diperbaiki";
    } elseif ($sess == 4 && $sts == 4) {
        return "Produsen data upload yang sdh diperbaiki";
    } elseif ($sess == 5 && $sts == 5) {
        return "Data perlu diperbaiki";
    } elseif ($sess == 2 && $sts == 5) {
        return "Data sedang diperbaiki";
    }
}
