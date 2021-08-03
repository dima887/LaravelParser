<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'name',
        'image',
        'price',
        'date',
        'title',
        'href',
        'address',
        'room',
        'description',
        'area',
        'metro',
        'appliances',
    ];

    public function getTitleAttribute($value)
    {
        return $this->attributes['title'] = htmlspecialchars_decode($value);
    }
    public function getDescriptionAttribute($value)
    {
        $value = $this->attributes['description'] = html_entity_decode($value);
        return mb_strimwidth($value, 0, 120, '...');
    }
    public function getImageAttribute($value)
    {
        $value = $this->attributes['image'];
        if ($value == null) {
            return 'https://vintage-crimea.ru/wp-content/uploads/2018/01/net-foto.png';
        }
        $pattern = '#^typo3temp.*#';
        $replacement = 'https://vintage-crimea.ru/wp-content/uploads/2018/01/net-foto.png';
        $pattern2 = '#(^app/.*)#';
        $replacement2 = 'storage/$1';
        $value = preg_replace($pattern, $replacement, $value);
        return preg_replace($pattern2, $replacement2, $value);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
