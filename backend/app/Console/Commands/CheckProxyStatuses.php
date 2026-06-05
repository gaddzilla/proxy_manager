<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckProxyStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-proxy-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CheckProxyStatuses';

    /**
     * Execute the console command.
     */
    public function handle(ProxyStatusChecker $checker): int
    {
        Proxy::query()
            ->orderBy('id')
            ->each(function (Proxy $proxy) use ($checker): void {
                $checker->check($proxy);
                $this->line(sprintf('%s:%d is %s', $proxy->host, $proxy->port, $proxy->status));
            });

        return self::SUCCESS;
    }
}
