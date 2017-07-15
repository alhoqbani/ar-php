<?php

namespace ArUtil\Text;

use ArUtil\I18N\Query;

class QueryBuilder extends Query
{
    
    protected $wheresReg = [];
    
    public function whereReg($field, $value)
    {
        array_push(
            $this->wheresReg,
            [
                'field' => $field,
                'value' => $value,
            ]);
        
        return $this;
    }
    
    public function getWheresReg()
    {
        return $this->wheresReg;
    }
    
    public function regexpy($string)
    {
        $words = preg_split("/\s+/", trim($string));
        if (count($words) == 1) {
    
            return  $this->lex($string);
        }
        foreach ($words as $word) {
            $patterns[] = $this->lex($word);
        }
        
        return $patterns;
    }
}