<?php
namespace NaverShopEp;

/**
 * 네이버샵 EP 3.0
 * Author: jonathanbak
 */
abstract class Base
{

    private $properties = null;

    public function __construct()
    {
        $this->properties = get_object_vars($this);
        unset($this->properties['properties']);
        foreach ($this->properties as $var => $val) {
            if($var !='properties'){
                $className = '\NaverShopEp\Type\\' . ucfirst($var);
                if (!class_exists($className)) throw new Exception("찾을수 없는 형식입니다. (" . $className . ")");
                if ($this->$var != null) {
                    $required = $this->$var;
                    $this->$var = new $className();
                    $this->$var->required($required);
                } else {
                    $this->$var = new $className();
                }
            }
        }
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function __call($method, $arguments)
    {
        if (!method_exists($this, $method)) {
            $param = count($arguments) > 0 ? $arguments[0] : '';
            $properties = $this->properties;
//            var_dump($properties);
            $propertyKeys = array_keys($properties);
            if (preg_match('/^set([a-zA-Z0-9-_]+)/i', $method, $tmpMatch)) {
                $var = strtolower($tmpMatch[1]);
                if (!in_array($var, $propertyKeys)) {
                    throw new Exception($var . " 해당 메소드를 찾을수 없습니다. (1001)");
                    return false;
                }
                if (is_object($this->$var)) {
                    $className = get_class($this->$var);
                    if ($param instanceof $className == true) {
                        $this->$var = $param;
                    } else {
                        if (is_object($param)) {
                            throw new Exception("잘못된 입력값(인스턴스)입니다 (" . $className . ")");
                            return false;
                        }
                        $this->$var->set($param);
                    }

                } else {
                    $className = '\NaverShopEp\Type\\' . ucfirst($var);
                    $param = new $className($param);
                    $this->$var = $param;
                }
//                $className = get_class($this->$var);
//                if($param instanceof $className == false) {
////                    $param = new $className($param);
//                }else {
//                    $this->$var->set($param);
//                }
//                $this->$var = $param;

                return true;
            } else if (preg_match('/^get([a-zA-Z0-9-_]+)/i', $method, $tmpMatch)) {
                $var = $tmpMatch[1];
                if (!in_array($var, $propertyKeys)) {
                    throw new Exception($var . "해당 메소드를 찾을수 없습니다. (1002)");
                    return false;
                }
                return $this->$var;
            }
        } else return true;
    }

    public function __toString()
    {
        return $this->parseObj($this);
    }

    public function parseObj($obj)
    {
        $properties = get_object_vars($obj);
        $result = array();
        foreach ($properties as $key => $value) {
            if($key !='properties'){
                if (strval($value) != Type::NULL) {
                    $result[$key] = strval($value);
                }
            }
        }
        //다시 순서대로 정렬
        $response = array();
        foreach($this->properties as $key => $val){
            $response[] = isset($result[$key])? $result[$key] : '';
        }
        return implode("\t", $response);
    }
}
