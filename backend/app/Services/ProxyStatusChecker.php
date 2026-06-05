<?php

namespace App\Services;

use App\Models\Proxy;
use Throwable;

class ProxyStatusChecker
{
    public const STATUS_UNKNOWN = 'unknown';
    public const STATUS_ONLINE = 'online';
    public const STATUS_OFFLINE = 'offline';

    public function check(Proxy $proxy): Proxy
    {
        $error = null;
        $status = self::STATUS_OFFLINE;

        try {
            $connection = @stream_socket_client(
                sprintf('tcp://%s:%d', $proxy->host, $proxy->port),
                $errorCode,
                $errorMessage,
                5
            );

            if ($connection !== false) {
                fclose($connection);
                $status = self::STATUS_ONLINE;
            } else {
                $error = trim($errorMessage) ?: 'Connection failed';
            }
        } catch (Throwable $exception) {
            $error = $exception->getMessage();
        }

        $proxy->forceFill([
            'status' => $status,
            'checked_at' => now(),
            'last_error' => $status === self::STATUS_ONLINE ? null : $error,
        ])->save();

        return $proxy->refresh();
    }
}
