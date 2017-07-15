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
        return $this->lex($string);
    }
}