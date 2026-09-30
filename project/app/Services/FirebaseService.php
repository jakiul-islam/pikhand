<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirebaseService
{
    public function sendNotification(
        string $deviceToken,
        string $title,
        string $body
    ) {
        // Service Account JSON পড়ুন
        $serviceAccount = json_decode(
            file_get_contents(config('services.firebase.service_account')),
            true
        );

        $clientEmail = $serviceAccount['client_email'];
        $privateKey = $serviceAccount['private_key'];

        // JWT তৈরি
        $now = time();

        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        $claimSet = [
            'iss' => $clientEmail,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
        ];

        $base64UrlEncode = function ($data) {
            return rtrim(
                strtr(
                    base64_encode($data),
                    '+/',
                    '-_'
                ),
                '='
            );
        };

        $encodedHeader = $base64UrlEncode(
            json_encode($header)
        );

        $encodedClaimSet = $base64UrlEncode(
            json_encode($claimSet)
        );

        $signatureInput =
            $encodedHeader . '.' . $encodedClaimSet;

        openssl_sign(
            $signatureInput,
            $signature,
            $privateKey,
            OPENSSL_ALGO_SHA256
        );

        $jwt =
            $signatureInput . '.' .
            $base64UrlEncode($signature);

        // Google OAuth Access Token
        $tokenResponse = Http::asForm()->post(
            'https://oauth2.googleapis.com/token',
            [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ]
        );

        if (!$tokenResponse->successful()) {
            throw new \Exception(
                'Google OAuth Error: ' .
                $tokenResponse->body()
            );
        }

        $accessToken =
            $tokenResponse->json('access_token');

        // Firebase HTTP v1
        $projectId = config(
            'services.firebase.project_id'
        );

        $response = Http::withToken($accessToken)
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

        return $response;
    }
}