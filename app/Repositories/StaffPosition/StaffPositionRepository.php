<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 00:33:37
 * File: StaffPosition.php
 */

namespace App\Repositories\StaffPosition;

use App\Models\StaffPosition;
use App\Repositories\EloquentRepository;

class StaffPositionRepository extends EloquentRepository implements StaffPositionInterface
{
	public function getModel(): string
	{
		return StaffPosition::class;
	}
}