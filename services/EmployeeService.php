<?php

require_once __DIR__ . '/../models/Employee.php';
require_once  __DIR__ . '/../utils/databases/DatabaseManager.php';

class EmployeeService {

    private static $instance;

    private function __construct() {
    }

    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new EmployeeService();
        }
        return self::$instance;
    }

    public function allEmployee(){
        $manager = DatabaseManager::getManager();
        return $manager->getAll('SELECT * FROM employee');
    }

    public function getById($id){
        $manager = DatabaseManager::getManager();
        $res = $manager->findOne('SELECT * FROM employee WHERE id = ?'[$id]);
        if($res){
            return Attraction::AttractionFromArray($res);
        }
        return null;
    }
}