<?php

namespace Tests\Feature;

use App\Models\Proxy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProxyApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_list_and_delete_proxy(): void
    {
        $this->postJson('/api/proxies', [
            'host' => 'proxy.example.com',
            'port' => 8080,
            'username' => 'user1',
        ])
            ->assertCreated()
            ->assertJsonPath('host', 'proxy.example.com')
            ->assertJsonPath('port', 8080);

        $this->assertDatabaseHas('proxies', [
            'host' => 'proxy.example.com',
            'port' => 8080,
            'status' => 'unknown',
        ]);

        $this->getJson('/api/proxies')
            ->assertOk()
            ->assertJsonCount(1);

        $proxy = Proxy::first();

        $this->deleteJson("/api/proxies/{$proxy->id}")
            ->assertNoContent();

        $this->assertDatabaseCount('proxies', 0);
    }
}
