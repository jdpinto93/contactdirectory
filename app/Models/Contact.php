<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'organization_id',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public static function scopeFilterBuilder($query, $search, $perPage)
    {
        $query = DB::table('contacts')
            ->join('organizations', 'contacts.organization_id', '=', 'organizations.id')
            ->select(
                'contacts.id',
                DB::raw('CONCAT(contacts.first_name, " ", contacts.last_name) AS full_name'),
                'contacts.phone',
                'contacts.city',
                'organizations.name AS organization'
            )
            ->orderBy('contacts.first_name');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where(DB::raw('CONCAT(contacts.first_name, " ", contacts.last_name)'), 'like', "%{$search}%")
                    ->orWhere('contacts.first_name', 'like', "%{$search}%")
                    ->orWhere('contacts.last_name', 'like', "%{$search}%")
                    ->orWhere('contacts.phone', 'like', "%{$search}%")
                    ->orWhere('contacts.city', 'like', "%{$search}%")
                    ->orWhere('organizations.name', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }
}
