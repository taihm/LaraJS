<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2022-08-02 23:43:11
 * File: DataExcel.php
 */
namespace App\Models;



class DataExcel extends BaseModel
{
	

    //Declare table name
    protected $table = 'data_excels';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
        'content',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
