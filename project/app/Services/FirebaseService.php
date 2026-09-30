<?php

namespace App\Services;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;

class FirebaseService
{
    public function sendNotification(
        string $deviceToken,
        string $title,
        string $body
    ) {
        $credentials = new ServiceAccountCredentials(
            'https://www.googleapis.com/auth/firebase.messaging',
            config('services.firebase.service_account')
        );

        $token = $credentials->fetchAuthToken()['access_token'];

        $projectId = config('services.firebase.project_id');

        return Http::withToken($token)
            ->post(
                "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
                [
                    'message' => [
                        'token' => $deviceToken,

                        'notification' => [
                            'title' => $title,
                            'body' => $body,
                        ],
                    ],
                ]
            );
    }
}