<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollectionResource extends ResourceCollection
{
    public static $wrap = '';
    public function toArray($request)
    {
        return $this->collection;
    }
}
