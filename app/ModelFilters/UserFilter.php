<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use phpDocumentor\Reflection\Types\Integer;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    //public $relations = [];

    //protected $blacklist = ['secretMethod'];


    public function searchAllStrings(string $string): UserFilter
    {

        $string = trim($string);

        if ($string) {
            return $this->where('id', $string)
                ->whereLike('nickname', $string, 'or')
                ->whereLike('name', $string, 'or');
        }
        return $this;
    }

    public function searchIsAdmin(bool $flag): UserFilter
    {
        if ($flag) {
            return $this->where('is_admin', $flag);
        }
        return $this;
    }

    public function searchOnlyDeleted(bool $flag): UserFilter
    {
        if ($flag) {
            return $this->whereNotNull('deleted_at');
        }
        return $this;
    }


}
