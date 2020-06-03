<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 *
 * @property int id
 * @property int county_id
 * @property string name
 * @property string zip
 * @property string lat
 * @property string lng
 * @property boolean zcta
 * @property string parent_zcta
 * @property string population
 * @property string density
 * @property boolean imprecise
 * @property boolean military
 * @property string timezone
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @package App\Models
 */
class City extends Model
{
    protected $fillable = [
        'county_id', 'name', 'zip', 'lat', 'lng', 'zcta', 'parent_zcta', 'population', 'density', 'imprecise',
        'military', 'timezone', 'created_at', 'updated_at'
    ];

    /**
     * County relation to this City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
