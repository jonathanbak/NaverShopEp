<?php
/**
 * 네이버쇼핑 EP 3.0
 * 데이터형 정의
 * Author: jonathanbak
 */
namespace NaverShopEp;


abstract class Type
{
    const NONE = '';
    const NULL = '__NULL__';
    protected $_required = null;
    protected $_maxsize = null;
    protected $_minsize = null;
    protected $_condition = null;
    protected $_value = null;

    public function __construct($value = null)
    {
        if($value!=null) $this->set($value);
    }

    public function required($required)
    {
        $this->_required = $required;
    }

    public function get()
    {
        return $this->_value;
    }

    public function set($value)
    {
        $this->validatedValue($value);
        $this->_value = $value;
        return $this;
    }

    public function validatedValue($value)
    {
        if ($this->_required !== null) {
            if ($this->_required === true) {
                if ($value === null || $value === self::NULL || $value === self::NONE) {
                    $className = get_class($this);
                    throw new Exception("필수입력값을 입력하지 않았습니다. (".$className.")");
                }
            }
        }
        if ($value !== null) {
            if ($this->_maxsize !== null) {
                if (strlen($value) > $this->_maxsize) $value = mb_substr($value, 0, 100, "UTF-8");

                if (strlen($value) > $this->_maxsize) {
                    throw new Exception('최대 입력가능 길이를 초과하였습니다. (' . $this->_maxsize . "자 이하)");
                }
            }
            if ($this->_minsize !== null) {
                if (strlen($value) < $this->_minsize) throw new Exception('최소 입력 길이 이하입니다. (' . $this->_minsize . "자 이상)");
            }
            if ($this->_condition !== null) {
//                $value = str_replace('.','',$value);
                if (!empty($value) && !preg_match('/' . $this->_condition . '/i', $value, $tmpMatch)) {
                    throw new Exception('입력 불가능한 문자를 입력하였습니다.' . get_class($this) . "(" . $value . ")");
                }
            }
        }
    }

    public function __toString()
    {
        return $this->_value === null ? self::NULL : $this->_value . '';
    }
}