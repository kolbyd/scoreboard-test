<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GameLog
 *
 * @property int $id
 * @property int $game_id
 * @property string $log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GameLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GameLog extends Model
{
    use HasFactory;
}
