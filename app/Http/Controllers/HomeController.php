<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
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

    public function home()
    {
        $carouselLabs = $this->getFromApi('carousel/laboratories');
        $standards = $this->getFromApi('standards');
        $reviews = $this->getFromApi('review');
        return view('pages.home', [
            'carouselLabs' => $carouselLabs['data'] ?? [],
            'standards' => $standards['data'] ?? [],
            'reviews' => $reviews['data'] ?? [],
        ]);
    }
}
