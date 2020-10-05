<?php


class ControllerModuleDataBase
{
    private $module;

    /**
     * ControllerUserDataBase constructor.
     * @param $module
     */
    public function __construct($module)
    {
        $this->module = $module;
    }

    private function bindInsertModule()
    {
        $name = $this->module->getName();
        ControllerDataBase::getInsertModule()->bindParam(':name', $name);
    }

    public function commit()
    {
        if (!self::lookForModule(self::getModule()->getName())) {
            ControllerDataBase::prepareInsertModule();
            $this->bindInsertModule();
            return ControllerDataBase::getInsertModule()->execute();
        }
        return false; //the module already exist
    }

    public static function lookForModule($name)
    {
        ControllerDataBase::prepareSelectSpecificModule();
        if (ControllerDataBase::getSelectSpecificModule()->execute(array($name))) {
            if($row = ControllerDataBase::getSelectSpecificModule()->fetch()) {
                return new Module($row['key'], $row['name']);
            }
        }
        return false;
    }

    public static function lookForAllModule()
    {
        $modules = array();
        ControllerDataBase::prepareSelectAllModule();
        if (ControllerDataBase::getSelectAllModule()->execute()) {
            while ($row = ControllerDataBase::getSelectAllModule()->fetch()) {
                $modules [$row['key']] = new Module($row['key'], $row['name']);
            }
            return $modules;
        }
        return null;
    }


    public function getModule()
    {
        return $this->module;
    }

    public static function deleteModule($moduleName)
    {
        ControllerDataBase::prepareDeleteModule();
        return ControllerDataBase::getDeleteModule()->execute(array($moduleName));
    }
}