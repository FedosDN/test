<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class County
 *
 * @property int id
 * @property int state_id
 * @property string fips
 * @property string name
 * @property string weights #json
 * @property string names_all
 * @property string fips_all
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @package App\Models
 */
class County extends Model
{
    /**
     * State relation to this County
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
