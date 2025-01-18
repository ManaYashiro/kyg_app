<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ReservationSession
{
    public static function get(): array
    {
        return Session::get("reservation_type_data") ?? [];
    }

    public static function store(string $process_id, array $insertData): void
    {
        $sessionData = self::get();
        $insertData['process_id'] = $process_id;

        // push or replace
        $sessionData = self::mergeToArray($sessionData, $insertData);

        Session::put("reservation_type_data", $sessionData);
    }

    public static function getProcessId(): string|null
    {
        return Session::get("current_process_id") ?? null;
    }

    public static function storeProcessId(string $process_id): void
    {
        Session::put("current_process_id", $process_id);
    }

    public static function pushToArray($sessionData, $insertData): array
    {
        // Flag to check if we found and replaced the item
        $replaced = false;

        // Iterate through the array to check if process_id already exists
        foreach ($sessionData as &$item) {
            if ($item['process_id'] === $insertData['process_id']) {
                // Replace the existing array with the new data
                $item = $insertData;
                $replaced = true;
                break;
            }
        }

        // If process_id wasn't found, push the new array
        if (!$replaced) {
            $sessionData[] = $insertData;
        }

        return $sessionData;
    }

    public static function mergeToArray($sessionData, $insertData): array
    {
        // Iterate through the insertData to merge with sessionData
        foreach ($insertData as $key => $value) {
            // If the key exists in sessionData, replace the value
            if (array_key_exists($key, $sessionData)) {
                $sessionData[$key] = $value;
            } else {
                // Otherwise, add the new key-value pair
                $sessionData[$key] = $value;
            }
        }

        return $sessionData;
    }

    public static function destroy(): void
    {
        Session::remove("current_process_id");
        Session::remove("reservation_type_data");
    }

    public static function generateProcessId(): string
    {
        return Str::random(10);
    }
}
