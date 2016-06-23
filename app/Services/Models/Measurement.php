<?php namespace App\Services\Models;

use Eloquent;
use App\User;

/**
 * Class Service
 *
 * @property \App\User                $author
 * @property \App\Services\Models\DifficultyLevel $difficulty_version
 */
class Measurement extends Eloquent {
    /**
     * @var string
     */
    protected $table = 'services_measurements';

	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
	}

    /*
     * @param int $value Value to detect declension
     */
    public function getNameByValue($value)
    {
        return $this->declension($value, [ $this->declension1, $this->declension2, $this->declension3 ]);
    }

    /*
     * @param int $int   Value to detect declension
     * @param int $expr  Expression to declension
     */
    public static function declension($int, $expr = array()){
        settype($int, "integer");
        $count = $int % 100;
        if ($count >= 5 && $count <= 20) {
            $result = $expr['2'];
        } else {
            $count = $count % 10;
            if ($count == 1) {
                $result = $expr['0'];
            } elseif ($count >= 2 && $count <= 4) {
                $result = $expr['1'];
            } else {
                $result = $expr['2'];
            }
        }
        return $result;
    }

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeWithAuthor($query)
	{
		return $query->with('author');
	}

}
