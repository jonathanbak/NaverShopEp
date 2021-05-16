<?php
/**
 * Author: jonathanbak
 * SQL 도움 유틸
 */
namespace NaverShopEp;


class SqlHelper
{
    public static function parseQuery($query, $params = array())
    {
        $params = self::arrayToRealEscape($params);
        $query = str_replace("%","%%",$query);
        $query = str_replace("??","%s",$query);
        $query = vsprintf(str_replace('?',"'%s'",$query),$params);
        return $query;
    }

    /**
     * 숫자형 배열을 홑따옴표로 묶어준다
     * @param array $arrayVal
     * @return array
     */
    public static function intArrayQuote( $arrayVal = array() )
    {
        $tmpVal = array();
        foreach($arrayVal as $val){
            $tmpVal[] = "'".self::realEscape($val)."'";
        }

        return $tmpVal;
    }

    /**
     * 키:값 배열을 쿼리문에 넣기좋게 만들어준다
     * @param array $params
     * @return array
     */
    public static function parseArrayToQuery( $params = array() )
    {
        $tmpVal = array();
        foreach($params as $k => $val){
            if(preg_match('/^([0-9]+)$/i',$k,$tmpMatch)==false) $tmpVal[] = " `$k` = "." '".self::realEscape($val)."'";
        }
        return $tmpVal;
    }

    /**
     * SQL Injection 방어 mysql_real_escape_string 실행
     * @param array $params
     * @return array
     */
    public static function arrayToRealEscape( $params = array() )
    {
        foreach($params as $k=> $value){
            $params[$k] = self::realEscapeString($value);
        }
        return $params;
    }

    /**
     * 배열,문자열 둘다 체크하여 수정
     * @param $value    array|string
     * @return array|string
     */
    public static function realEscape( $value )
    {
        if(is_array($value)) {
            $value = self::arrayToRealEscape($value);
        }else{
            $value = self::realEscapeString($value);
        }

        return $value;
    }

    /**
     * get_magic_quotes_gpc 체크하여 addslashes
     * @param $value
     * @return string
     */
    public static function realEscapeString( $value )
    {
        if(!self::isAlreadyEscape($value)) $value = get_magic_quotes_gpc()? $value : addslashes( $value );
        return $value;
    }

    public static function isAlreadyEscape($value)
    {
        $alreadyEscape = true;
        $searchValueTmp = str_replace("\\'",'&#39;', $value);
        $searchValueTmp = str_replace("\\\\",'&#39;', $searchValueTmp);
        $searchValueTmp = str_replace("\\\"",'&quot;', $searchValueTmp);
        if(preg_match_all('/([\']|[\"]|[\\\])/i',$searchValueTmp,$tmpMatches2)){
            $alreadyEscape = false;
        }
        return $alreadyEscape;
    }
}