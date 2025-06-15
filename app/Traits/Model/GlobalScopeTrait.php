<?php
/**
 * Created by PhpStorm.
 * User: Al
 * Date: 3/7/2020
 * Time: 11:28 م
 */

namespace App\Traits\Model;

use App\Scopes\ActiveScopes;
use Illuminate\Database\Query\Builder;

trait GlobalScopeTrait
{

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScopes);
    }
}