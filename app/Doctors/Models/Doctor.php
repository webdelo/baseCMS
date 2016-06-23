<?php namespace App\Doctors\Models;

use App\Employees\Models\Employee;
use Eloquent;

/**
 * Class Doctor
 *
 */
class Doctor extends Eloquent
{

	/**
	 * @var array
	 */
	protected $guarded = ['id'];

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
	 * @return Employee
	 */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employeeId');
    }

	public function __call($name, $arguments)
	{
		return call_user_func_array(array($this->employee(), $name), $arguments);
	}
}
