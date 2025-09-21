<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.profile');
    }

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

    public function fetchTeamData()
    {
        $teamData = $this->getFromApi('team');
        $teams = $teamData['data'] ?? [];

        if (empty($teams)) {
            return response()->json(['grouped_teams' => []]);
        }

        $grouped = [];
        foreach ($teams as $member) {
            if (isset($member['position']['hierarchy'])) {
                $hierarchy = $member['position']['hierarchy'];
                if (!isset($grouped[$hierarchy])) {
                    $grouped[$hierarchy] = [];
                }
                $grouped[$hierarchy][] = $member;
            }
        }
        
        // Urutkan grup berdasarkan kuncinya (hierarki 1, 2, 3...)
        ksort($grouped);

        return response()->json(['grouped_teams' => $grouped]);
    }
}
