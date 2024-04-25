<?php

namespace App\Console\Commands;

use App\Jobs\ImportGarden;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Modules\Garden\Entities\Garden;

class ImportGardenBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'garden:import {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports all gardens data batch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $folder = $this->argument('folder');
        $folder = $folder ? base_path($folder) : $folder;
        if (!is_dir($folder)) {
            $this->error("Folder not found: ".$folder);
            return 0;
        }
        $this->scanAndImportByCode($folder);
        return 0;
    }

    public function scanAndImportByCode($folder)
    {
        $gardens = Garden::query()->pluck('code', 'code')->toArray();
        $usedGardens = [];
        foreach (scandir($folder) as $item) {
            $file = "$folder/$item";
            if (!file_exists($file) || !is_file($file)) continue;
            if (Str::startsWith($item, '.')) continue;
            $pathInfo = pathinfo($item);
            if (!isset($pathInfo['extension'])) dd($pathInfo, $item);
            if ($pathInfo['extension'] !== 'xlsx' && $pathInfo['extension'] !== 'xls') continue;

            $garden = $this->searchGarden(array_keys($gardens), $item);
            if (!$garden) {
                $garden = $this->searchGarden($usedGardens, $item);
                if ($garden)
                    $this->info("File was ignored, garden is duplicate: ".$item);
                else
                    $this->info("File was ignored, garden not found: ".$item);
                continue;
            }
            $usedGardens[] = $garden;
            unset($gardens[$garden]);
            $garden = Garden::query()->where('code', $garden)->first();
            $this->importGarden($garden, $file);
            $this->info("Garden ".$garden->code." queued");
        }
    }

    protected function importGarden(Garden $garden, $file)
    {
        return dispatch((new ImportGarden($garden, $file)));
    }

    protected function searchGarden(array $codes, string $search): ?string
    {
        $search = strtolower($search);
        $search = str_replace(['cagalar', 'çagalar', ' ', '_', '.',], '-', $search);
        foreach ($codes as $item) {
            if (Str::startsWith(strtolower($search), strtolower($item).'-')) {
                return $item;
            }
        }
        return null;
    }
}
