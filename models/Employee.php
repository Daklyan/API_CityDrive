<?php

require_once __DIR__ . '/../utils/Validator.php';

class Employee implements JsonSerializable {

    private $id;
    private $fName;
    private $sName;
    private $bday;
    private $email;
    private $psswd;

    public static function employeeFromArray($data) {
        if (Validator::validate($data, ['firstName', 'secondName', 'birthday', 'email', 'password'])) {
            $p = new Employee(NULL, $data['firstName'], $data['secondName'], $data['birthday'], $data['email'], $data['password']);
            if (isset($data['id'])) {
                $p->setId($data['id']);
            }
            return $p;
        }
        return null;
    }


/**
 * Employee constructor.
 * @param $id
 * @param $fName
 * @param $sName
 * @param $bday
 * @param $email
 * @param $psswd
 */
public
function __construct($id, $fName, $sName, $bday, $email, $psswd) {
    $this->id = $id;
    $this->fName = $fName;
    $this->sName = $sName;
    $this->bday = $bday;
    $this->email = $email;
    $this->psswd = $psswd;
}

/**
 * @return mixed
 */
public
function getId() {
    return $this->id;
}

/**
 * @param mixed $id
 */
public
function setId($id) {
    $this->id = $id;
}

/**
 * @return mixed
 */
public
function getFName() {
    return $this->fName;
}

/**
 * @param mixed $fName
 */
public
function setFName($fName) {
    $this->fName = $fName;
}

/**
 * @return mixed
 */
public
function getSName() {
    return $this->sName;
}

/**
 * @param mixed $sName
 */
public
function setSName($sName) {
    $this->sName = $sName;
}

/**
 * @return mixed
 */
public
function getBday() {
    return $this->bday;
}

/**
 * @param mixed $bday
 */
public
function setBday($bday) {
    $this->bday = $bday;
}

/**
 * @return mixed
 */
public
function getEmail() {
    return $this->email;
}

/**
 * @param mixed $email
 */
public
function setEmail($email) {
    $this->email = $email;
}

/**
 * @return mixed
 */
public
function getPsswd() {
    return $this->psswd;
}

/**
 * @param mixed $psswd
 */
public
function setPsswd($psswd) {
    $this->psswd = $psswd;
}

public
function jsonSerialize() {
    return get_object_vars($this);
}

}