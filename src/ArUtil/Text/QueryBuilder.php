<?php

namespace ArUtil\Text;

class QueryBuilder
{
    
    protected $wheresReg = [];
    
    public function whereReg($field, $value)
    {
        $this->wheresReg[] = "WHERE `{$field}` REGEXP '{$value}'";
        
        return $this;
    }
    
    public function getWheresReg()
    {
        return $this->wheresReg;
    }
}