<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 00:33:37
 * File: StaffPosition.php
 */
namespace App\Models;



class StaffPosition extends BaseModel
{
	

    //Declare table name
    protected $table = 'staff_positions';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
        'description',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
