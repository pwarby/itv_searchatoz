<?php

interface RequestInterface{
    public function request($url, $cache = true);
}