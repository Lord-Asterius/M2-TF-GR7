<?php


class TestUtils
{
    public static function cleanTables()
    {
        ControllerDataBase::exec('DELETE FROM module');
        ControllerDataBase::exec('DELETE FROM user');
        ControllerDataBase::exec('DELETE FROM absence');
        ControllerDataBase::exec('DELETE FROM enseigant_referent');
        ControllerDataBase::exec('DELETE FROM user_module');
    }

    public static function CreateDataTestSet()
    {
        ControllerDataBase::exec('INSERT INTO `user` (`key`, `id`, `password`, `first_name`, `last_name`, `mail`, `role`, `date_naissance`) VALUES (\'1\', \'JTarien\', \'Az12@4567\', \'Jean\', \'Tanrien\', \'Jean.Tanrien@mail.com\', \'ENSEIGNANT\', \'2020-09-01\') ');
        ControllerDataBase::exec('INSERT INTO `user` (`key`, `id`, `password`, `first_name`, `last_name`, `mail`, `role`, `date_naissance`) VALUES (\'2\', \'GMendufric\', \'Az12@4567\', \'Gerard\', \'Mendufric\', \'Gerard.Mendufric@mail.com\', \'ENSEIGNANT\', \'2020-09-01\')');

        ControllerDataBase::exec('INSERT INTO `user` (`key`, `id`, `password`, `first_name`, `last_name`, `mail`, `role`, `date_naissance`) VALUES (\'3\', \'GHotine\', \'Az12@4567\', \'Guy\', \'Hotine\', \'Guy.Hotine@mail.com\', \'ETUDIANT\', \'2020-09-01\')');
        ControllerDataBase::exec('INSERT INTO `user` (`key`, `id`, `password`, `first_name`, `last_name`, `mail`, `role`, `date_naissance`) VALUES (\'4\', \'DDormi\', \'Az12@4567\', \'Djamal\', \'Dormi\', \'Djamal.Dormi@mail.com\', \'ETUDIANT\', \'2020-09-01\')');

        ControllerDataBase::exec('INSERT INTO module (`key`, name) VALUES (\'1\', \'test pas vraiment fonctionnelle\')');
        ControllerDataBase::exec('INSERT INTO module (`key`, name) VALUES (\'2\', \'etude de trucs\')');

        ControllerDataBase::exec('INSERT INTO absence(`key`, reason, etudiant_key, comment, date_time) VALUES (\'1\', \'\', \'3\', \'\', \'2020-10-15 13:31:47\')');

        ControllerDataBase::exec('INSERT INTO absence(`key`, reason, etudiant_key, comment, date_time) VALUES (\'2\', \'\', \'4\', \'gnugnu\', \'2020-10-15 13:31:47\')');
        ControllerDataBase::exec('INSERT INTO absence(`key`, reason, etudiant_key, comment, date_time) VALUES (\'3\', \'\', \'4\', \'\', \'2020-10-15 13:31:47\')');
        ControllerDataBase::exec('INSERT INTO absence(`key`, reason, etudiant_key, comment, date_time) VALUES (\'4\', \'\', \'4\', \'\', \'2020-10-15 13:31:47\')');
        ControllerDataBase::exec('INSERT INTO absence(`key`, reason, etudiant_key, comment, date_time) VALUES (\'5\', \'\', \'4\', \'\', \'2020-10-15 13:31:47\')');

        ControllerDataBase::exec('INSERT INTO enseigant_referent(enseigant_key, module_key) VALUES (\'1\', \'1\')');

        ControllerDataBase::exec('INSERT INTO user_module(user_key, module_key) VALUES (\'1\', \'2\')');
        ControllerDataBase::exec('INSERT INTO user_module(user_key, module_key) VALUES (\'2\', \'1\')');
        ControllerDataBase::exec('INSERT INTO user_module(user_key, module_key) VALUES (\'3\', \'1\')');
        ControllerDataBase::exec('INSERT INTO user_module(user_key, module_key) VALUES (\'4\', \'1\')');

    }
}