<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.php
 */
namespace App\Models;



class Staff extends BaseModel
{
	

    //Declare table name
    protected $table = 'staff';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'building_id',
        'user_id',
        'staff_position_id',
        'status',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
