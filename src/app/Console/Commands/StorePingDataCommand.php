<?php

namespace App\Console\Commands;

use App\Models\PingData;
use Illuminate\Console\Command;

class StorePingDataCommand extends Command
{
    protected $signature = 'store:ping {text_file_input}';
    protected $description = 'Store ping command data';

    public function handle()
    {
        $ping_data = file_get_contents($this->argument('text_file_input'));

        preg_match('/PING ((?:\d{1,3}\.){3}\d{1,3})/', $ping_data, $server_ip);
        preg_match('/(\d*) packets transmitted/', $ping_data, $packet_count);
        preg_match('/, (\d*) received/', $ping_data, $packet_received);
        preg_match('/, (\d*)% packet loss/', $ping_data, $packet_loss);
        preg_match('/rtt min\/avg\/max\/mdev = (\d*\.\d*)\/(\d*\.\d*)\/(\d*\.\d*)\/(\d*\.\d*) ms/', $ping_data, $rtt);
        preg_match('/, ipg\/ewma (\d*\.\d*)\/(\d*\.\d*) ms/', $ping_data, $ipg_ewma);

        $pd = new PingData();
        $pd->raw_data = $ping_data;
        $pd->server = $server_ip[1];
        $pd->packet_count = $packet_count[1];
        $pd->packet_received = $packet_received[1];
        $pd->packet_loss = $packet_loss[1];
        $pd->rtt_min = $rtt[1];
        $pd->rtt_avg = $rtt[2];
        $pd->rtt_max = $rtt[3];
        $pd->rtt_mdev = $rtt[4];
        $pd->ipg = $ipg_ewma[1];
        $pd->ewma = $ipg_ewma[2];
        $pd->save();
    }

}
