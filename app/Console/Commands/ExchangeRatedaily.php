<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\ExchangeRate;

class ExchangeRatedaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Exchange:Rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email';

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
        $data = Http::get('https://openexchangerates.org/api/latest.json?app_id=1d198fa2354940eca5d4bb7a85983404')->json();
        $base = $data['base'];
        $rates =   $data['rates'];
        $rat =    count($rates);

        $exchange = ExchangeRate::all();

        $i = 0;
        if ($exchange == '[]' || $exchange == null) {
            foreach ($rates as $key => $value) {
                if ($rat >= $i) {
                    $rates = new ExchangeRate();
                    $rates->base = $base;
                    $rates->rates = $key;
                    $rates->money = $value;
                    $rates->save();
                    $i = $i + 1;
                }
            }
        } else {

            foreach ($rates as $key => $value) {
                if ($rat >= $i) {
                    $rates = ExchangeRate::where('rates', $key)->first();

                    $rates->update([
                        $rates->money = $value,
                    ]);


                    $i = $i + 1;
                }
            }
        }

        $this->info('Everday get Exchange data');
    }
}