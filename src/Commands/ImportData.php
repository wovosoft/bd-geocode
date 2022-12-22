<?php

namespace Wovosoft\BdGeocode\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;

class ImportData extends Command
{
    private ?array $divisions, $districts, $upazilas, $unions;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bd-geocode:import-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws FileNotFoundException|\Throwable
     */
    public function handle(): int
    {

        $path = "app/public/bangladesh-geocode/bangladesh-geocode-master";
        //merging all files in a tree structured array/object

        $this->divisions = json_decode(
            File::get(storage_path("$path/divisions/divisions.json"))
        )[2]->data;

        $this->districts = json_decode(
            File::get(storage_path("$path/districts/districts.json"))
        )[2]->data;

        $this->upazilas = json_decode(
            File::get(storage_path("$path/upazilas/upazilas.json"))
        )[2]->data;

        $this->unions = json_decode(
            File::get(storage_path("$path/unions/unions.json"))
        )[2]->data;

        foreach ($this->divisions as $division) {
            $div = new Division();
            $div->name = $division->name;
            $div->bn_name = $division->bn_name;
            $div->url = $division->url;
            $div->saveOrFail();

            $this->insertDistricts($division->id, $div->id);
        }

        return 0;
    }


    /**
     * @throws FileNotFoundException
     * @throws \Throwable
     */
    private function insertDistricts($data_id, $model_id)
    {
        $districts = Arr::where($this->districts, fn($value, $key) => $value->division_id === $data_id);
        foreach ($districts as $district) {
            $dis = new District();
            $dis->forceFill([
                "division_id" => $model_id,
                "name" => $district->name,
                "bn_name" => $district->bn_name,
                "lat" => $district->lat,
                "lon" => $district->lon,
                "url" => $district->url
            ])->saveOrFail();
            $this->insertUpazilas($district->id, $dis->id);
        }
    }

    /**
     * @throws \Throwable
     */
    private function insertUpazilas($data_id, $model_id)
    {
        $upazilas = Arr::where($this->upazilas, fn($value, $key) => $value->district_id === $data_id);
        foreach ($upazilas as $upazila) {
            $upz = new Upazila();
            $upz->forceFill([
                "district_id" => $model_id,
                "name" => $upazila->name,
                "bn_name" => $upazila->bn_name,
                "url" => $upazila->url
            ])->saveOrFail();
            $this->insertUnions($upazila->id, $upz->id);
        }
    }


    /**
     * @throws \Throwable
     */
    private function insertUnions($data_id, $model_id)
    {
        $unions = Arr::where($this->unions, fn($value, $key) => $value->upazilla_id === $data_id);
        foreach ($unions as $union) {
            (new Union())->forceFill([
                "upazila_id" => $model_id,
                "name" => $union->name,
                "bn_name" => $union->bn_name,
                "url" => $union->url
            ])->saveOrFail();
        }
    }
}
