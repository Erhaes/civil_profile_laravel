<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Pagination\LengthAwarePaginator;

class TestController extends Controller
{
    private function getFromApi(string $endpoint, array $params = []): array
    {
        $apiBaseUrl = config('services.api.base_url');

        try {
            $response = Http::get("{$apiBaseUrl}/{$endpoint}", $params);

            if ($response->failed()) {
                // Return an error structure if API returns non-successful status
                return ['error' => 'Gagal mengambil data dari server.', 'status' => $response->status()];
            }

            return $response->json() ?? [];

        } catch (ConnectionException $e) {
            // Return an error structure if connection fails
            report($e);
            return ['error' => 'Tidak dapat terhubung ke server API.', 'status' => 503];
        }
    }

    private function createPaginator(array $apiResponse, Request $request): LengthAwarePaginator
    {
        $items = $apiResponse['data'] ?? [];
        $total = $apiResponse['total'] ?? 0;
        $perPage = $apiResponse['per_page'] ?? 10;
        $currentPage = $apiResponse['current_page'] ?? 1;

        $collection = new Collection($items);

        return new LengthAwarePaginator(
            $collection,
            $total,
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    public function tests(Request $request)
    {
        $page = $request->input('page', 1);
        $apiResponse = $this->getFromApi('tests', ['page' => $page, 'per_page' => 8, 'is_active' => 1]);
        
        $tests = $this->createPaginator($apiResponse, $request);

        return view('pages.tests.index', compact('tests'));
    }

    public function testDetail($slug)
    {
        $apiResponse = $this->getFromApi("tests/{$slug}");
        return view('pages.tests.show', ['test' => $apiResponse['data'] ?? null]);
    }
}
