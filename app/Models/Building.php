<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-22 23:20:18
 * File: Building.php
 */
namespace App\Models;



class Building extends BaseModel
{
	

    //Declare table name
    protected $table = 'buildings';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
        'address',
        'status',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
