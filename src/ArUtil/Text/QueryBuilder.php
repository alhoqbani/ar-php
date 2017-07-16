<?php

namespace ArUtil\Text;

use ArUtil\I18N\Query;

class QueryBuilder extends Query
{
    
    protected $wheresReg = [];
    protected $columns;
    protected $table;
    
    public function whereReg($field, $value, $boolean = 'AND')
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
                'field'   => '`' . $field . '`',
                'value'   => $value,
                'pattern' => $this->regexpy($value),
                'boolean' => $boolean,
            ]);
        
        return $this;
    }
    
    public function select($columns)
    {
        $this->columns = ' `' . implode('`, `', (array)$columns) . '` ';
        
        return $this;
    }
    
    public function getColumns()
    {
        return isset($this->columns) ? $this->columns : ' * ';
    }
    
    public function from($table)
    {
        $this->table = "`$table`";
        
        return $this;
    }
    
    public function getTable()
    {
        return $this->table;
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
    
    public function toFullSql()
    {
        $sql = $this->sqlPrefix();
        $sql .= $this->getWheresRegString();
        
        return $sql;
    }
    
    private function getWheresRegString()
    {
        $whereClauses = " WHERE ";
        foreach ($this->prepareWheresReg() as $clause) {
            $whereClauses .= $clause;
        }
        
        return $whereClauses;
    }
    
    private function prepareWheresReg()
    {
        $count = count($this->wheresReg);
        $i = 0;
        $wheres = [];
        $clause = '';
        for (; $i < $count; $i++) {
            $params = $this->wheresReg[$i];
            if ($i > 0) {
                $clause .= ' ' . $params['boolean'] . ' ';
            }
            $clause .= $params['field'] . " REGEXP '" . $params['pattern'] . "'";
            $wheres[] = $clause;
            $clause = '';
        }
        
        return $wheres;
    }
    
    /**
     * @return string
     */
    private function sqlPrefix()
    {
        $sql = "SELECT" . $this->getColumns() . "FROM ";
        $sql .= $this->table;
        
        return $sql;
    }
}