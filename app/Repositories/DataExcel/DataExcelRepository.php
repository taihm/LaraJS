<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-08-02 23:43:11
 * File: DataExcel.php
 */

namespace App\Repositories\DataExcel;

use App\Models\DataExcel;
use App\Repositories\EloquentRepository;

class DataExcelRepository extends EloquentRepository implements DataExcelInterface
{
	public function getModel(): string
	{
		return DataExcel::class;
	}
}