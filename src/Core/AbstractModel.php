<?php


Abstract class AbstractModel{
    protected Database $db;

    function __construct(){
        $this->db=new Database();
    }
}