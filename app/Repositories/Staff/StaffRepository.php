<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.php
 */

namespace App\Repositories\Staff;

use App\Models\Staff;
use App\Repositories\EloquentRepository;

class StaffRepository extends EloquentRepository implements StaffInterface
{
	public function getModel(): string
	{
		return Staff::class;
	}
}