<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-09-23 01:00:48
 * File: SupportService.php
 */
namespace App\Models;



class SupportService extends BaseModel
{
	

    //Declare table name
    protected $table = 'support_services';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
        'description',
        'fee',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
