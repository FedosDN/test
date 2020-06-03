<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 *
 * @property int id
 * @property string abbreviation
 * @property string name
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @package App\Models
 */
class State extends Model
{
    /**
     * Counties relation to this State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function counties()
    {
        return $this->hasMany(County::class);
    }
}
