<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StoreSpeedtestCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:speedtest {text_file_input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store speedtest data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $speedtest_data = file_get_contents($this->argument('text_file_input'));

        preg_match('/Ping: (\d*\.\d*) ms/', $speedtest_data, $ping);
        preg_match('/Download: (\d*\.\d*) Mbit\/s\n/', $speedtest_data, $download);
        preg_match('/Upload: (\d*\.\d*) Mbit\/s\n/', $speedtest_data, $upload);

        $st = new \App\Models\Speedtest();
        $st->raw_data = $speedtest_data;
        $st->ping = $ping[1];
        $st->download = $download[1];
        $st->upload = $upload[1];
        $st->save();
    }

}
