<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use phpDocumentor\Reflection\Types\Integer;

class FileFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    //public $relations = [];

    //protected $blacklist = ['secretMethod'];


    public function searchAllStrings(string $string): FileFilter
    {

        $string = trim($string);

        if ($string) {
            return $this->where('id', $string)
                ->whereLike('name_local', $string, 'or')
                ->whereLike('name_visible', $string, 'or');
        }
        return $this;
    }

    public function searchOnlyDeleted(bool $flag): FileFilter
    {
        if ($flag) {
            return $this->whereNotNull('deleted_at');
        }
        return $this;
    }


}
