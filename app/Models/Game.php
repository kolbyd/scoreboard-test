<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game
 *
 * @property int $id
 * @property int $home_team_id
 * @property int $home_score
 * @property int $home_shots
 * @property int $visitor_team_id
 * @property int $visitor_score
 * @property int $visitor_shots
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHomeScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHomeShots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereVisitorScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereVisitorShots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereVisitorTeamId($value)
 * @mixin \Eloquent
 */
class Game extends Model
{
    use HasFactory;

    protected $guarded = [];
}
