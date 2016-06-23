<?php namespace App\Schedule\Models;

use App\Interfaces\Imaginable;
use App\Patients\Models\Patient;
use Eloquent;
use App\User;

/**
 * Class Visit
 *
 * @property \App\User                $author
 */
class Schedule extends Eloquent {

    /**
     * @var array
     */
    protected $guarded = ['id', 'author_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'statusId');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithAuthor($query)
    {
        return $query->with('author');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patientId');
    }

    public function getNote()
    {
        return $this->note;
    }
}