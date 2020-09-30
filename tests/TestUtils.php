<?php


class TestUtils
{
    public static function cleanTables(){
        ControllerDataBase::exec('DELETE FROM module');
        ControllerDataBase::exec('DELETE FROM user');
        ControllerDataBase::exec('DELETE FROM absence');
        ControllerDataBase::exec('DELETE FROM enseigant_referent');
        ControllerDataBase::exec('DELETE FROM user_module');
    }
}