<?php

namespace App;


class Cart
{
    public $items=null ;
    public $totQt=0 ;
    // public $totPrice=0 ;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items=$oldCart->items;
            $this->totQt=$oldCart->totQt;
            // $this->totPrice=$oldCart->totPrice;

        }
    }

    public function add($item,$id)
    {
        $storedItem=['Qt'=>0,'item'=>$item];
        if($this->items)
        {
            if(array_key_exists($id,$this->items))
            {
                $storedItem=$this->items[$id];
            }
        }
        $storedItem['Qt']++;
        $this->items[$id]=$storedItem;
        $this->totQt++;

    }
    
}
