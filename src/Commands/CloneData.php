<?php

namespace Wovosoft\BdGeocode\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class CloneData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bd-geocode:clone-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clones data from https://github.com/nuhil/bangladesh-geocode before Importing to database';

    /**
     * Execute the console command.
     * 1. First checks if storage_path("app/public/bangladesh-geocode") exits,
     *      if exits, then it clears the folder. So, developer should be aware that this folder will be deleted.
     * 2. Clones static data from https://github.com/nuhil/bangladesh-geocode.git to the folder which is deleted.
     * @return int
     */
    public function handle(): int
    {
        if (File::exists(storage_path("app/public/bangladesh-geocode"))) {
            File::deleteDirectory(storage_path("app/public/bangladesh-geocode"));
        }

        if (!File::exists(storage_path("app/public/bangladesh-geocode"))) {
            File::makeDirectory(storage_path("app/public/bangladesh-geocode"));
        }

        $file = file_get_contents("https://github.com/nuhil/bangladesh-geocode/archive/refs/heads/master.zip");
        file_put_contents(storage_path("app/public/bangladesh-geocode/bangladesh-geocode.zip"), $file);

        $zip = new ZipArchive();

        $zipFile = $zip->open(storage_path("app/public/bangladesh-geocode/bangladesh-geocode.zip"));
        if ($zipFile === TRUE) {
            $zip->extractTo(storage_path("app/public/bangladesh-geocode"));
            $zip->close();
        }
        return 0;
    }
}
