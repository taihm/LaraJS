<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-22 23:20:18
 * File: Building.php
 */

namespace App\Repositories\Building;

use App\Models\Building;
use App\Repositories\EloquentRepository;

class BuildingRepository extends EloquentRepository implements BuildingInterface
{
	public function getModel(): string
	{
		return Building::class;
	}
}