<?php

function escape ($string) {
    htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $string;
}
