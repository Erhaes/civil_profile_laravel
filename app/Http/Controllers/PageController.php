<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Pagination\LengthAwarePaginator;

class PageController extends Controller
{
    /**
     * Helper function to fetch data from the external API.
     * It handles API connection errors gracefully.
     *
     * @param string $endpoint The API endpoint to call.
     * @param array $params Query parameters for the request.
     * @return array The JSON decoded data or an empty array with an error.
     */
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

    public function profile()
    {
        return view('pages.profile');
    }

    public function facilities(Request $request)
    {
        $page = $request->input('page', 1);
        $apiResponse = $this->getFromApi('labs', ['page' => $page, 'per_page' => 16]);
        
        $facilities = $this->createPaginator($apiResponse, $request);

        return view('pages.facilities.index', compact('facilities'));
    }
    
    public function facilityDetail($slug)
    {
        $apiResponse = $this->getFromApi("labs/{$slug}");
        return view('pages.facilities.show', ['facility' => $apiResponse['data'] ?? null]);
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

    public function news(Request $request)
    {
        $page = $request->input('page', 1);
        $apiResponse = $this->getFromApi('news', ['page' => $page, 'per_page' => 8]);
        
        $news = $this->createPaginator($apiResponse, $request);

        return view('pages.news.index', compact('news'));
    }

    public function newsDetail($slug)
    {
        $apiResponse = $this->getFromApi("news/{$slug}");
        return view('pages.news.show', ['newsItem' => $apiResponse['data'] ?? null]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function downloads(Request $request)
    {
        $page = $request->input('page', 1);
        $apiResponse = $this->getFromApi('downloads', ['page' => $page, 'per_page' => 2]);
        
        $downloads = $this->createPaginator($apiResponse, $request);

        return view('pages.downloads', compact('downloads'));
    }
}