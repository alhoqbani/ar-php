<?php

namespace ArUtil\Text;

use ArUtil\I18N\Query;

class QueryBuilder extends Query
{
    
    protected $wheresReg = [];
    protected $columns;
    
    public function whereReg($field, $value, $boolean = 'and')
    {
        $words = preg_split("/\s+/", trim($value));
        
        if (count($words) > 1) {
            foreach ($words as $word) {
                $this->whereReg($field, $word, $boolean);
            }
            
            return $this;
        }
        
        array_push(
            $this->wheresReg,
            [
                'field'   => $field,
                'value'   => $value,
                'pattern' => $this->regexpy($value),
                'boolean' => $boolean,
            ]);
        
        return $this;
    }
    
    public function select(array $columns)
    {
        $this->columns = ' `' . implode('`, `', $columns) . '` ';
    }
    
    public function getColumns()
    {
        return isset($this->columns) ? $this->columns : '*';
    }
    
    public function getWheresReg()
    {
        return $this->wheresReg;
    }
    
    public function regexpy($text)
    {
        if (is_array($text)) {
            return array_map(function ($word) {
                return $this->lex($word);
            }, $text);
        }
        
        $words = preg_split("/\s+/", trim($text));
        if (count($words) == 1) {
            
            return $this->lex(trim($text));
        }
        $patterns = [];
        foreach ($words as $word) {
            $patterns[] = $this->lex($word);
        }
        
        return $patterns;
    }
}