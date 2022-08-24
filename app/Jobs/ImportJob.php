<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use App\Imports\DataRawImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uploadFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('ImportJob');

        $data = head(Excel::toArray(new DataRawImport(), $this->uploadFile, 'local', \Maatwebsite\Excel\Excel::CSV));
        $chunk = collect($data)->chunk(1000);
        $insert_data = [];
        foreach ($chunk as $data) {
            foreach ($data as $row) {
                $dataInsert = [];
                $dataInsert['name'] = $row['user'];
                $dataInsert['content'] = $row['description'];
                $dataInsert['created_at'] = Carbon::now();
                $insert_data[] = $dataInsert;
            }
        }

        if (!empty($insert_data)) {
            Log::debug('Count row insert = ' . count($insert_data));
            $this->insert($insert_data);
        }
    }

    public function insert($insert_data)
    {
        $insert_data = collect($insert_data);
        $chunks = $insert_data->chunk(1000);
        foreach ($chunks as $chunk) {
            DB::table('data_excels')->insert($chunk->toArray());
        }
    }
}
