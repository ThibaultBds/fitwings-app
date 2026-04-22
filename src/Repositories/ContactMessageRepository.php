<?php

namespace App\Repositories;

use App\Core\MongoConnection;
use MongoDB\BSON\UTCDateTime;

class ContactMessageRepository
{
    private ?string $lastError = null;

    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    public function create(array $data): bool
    {
        $this->lastError = null;

        try {
            $collection = MongoConnection::getDatabase()->selectCollection('contact_messages');
            $collection->insertOne([
                'nom' => $data['nom'] ?? '',
                'email' => $data['email'] ?? '',
                'message' => $data['message'] ?? '',
                'ip' => $data['ip'] ?? '',
                'user_agent' => $data['user_agent'] ?? '',
                'created_at' => new UTCDateTime(),
            ]);

            return true;
        } catch (\Throwable $e) {
            $this->lastError = 'MongoDB indisponible.';
            return false;
        }
    }

    public function findRecent(int $limit = 50): array
    {
        $this->lastError = null;

        try {
            $collection = MongoConnection::getDatabase()->selectCollection('contact_messages');
            $cursor = $collection->find([], [
                'sort' => ['created_at' => -1],
                'limit' => $limit,
            ]);

            $items = [];
            foreach ($cursor as $doc) {
                $items[] = $this->normalizeDoc($doc);
            }

            return $items;
        } catch (\Throwable $e) {
            $this->lastError = 'MongoDB indisponible.';
            return [];
        }
    }

    private function normalizeDoc(array $doc): array
    {
        $createdAt = $doc['created_at'] ?? null;
        if ($createdAt instanceof UTCDateTime) {
            $createdAt = $createdAt->toDateTime()->format('Y-m-d H:i');
        } elseif ($createdAt instanceof \DateTimeInterface) {
            $createdAt = $createdAt->format('Y-m-d H:i');
        } else {
            $createdAt = (string)($createdAt ?? '');
        }

        return [
            'id' => isset($doc['_id']) ? (string)$doc['_id'] : '',
            'nom' => (string)($doc['nom'] ?? ''),
            'email' => (string)($doc['email'] ?? ''),
            'message' => (string)($doc['message'] ?? ''),
            'ip' => (string)($doc['ip'] ?? ''),
            'user_agent' => (string)($doc['user_agent'] ?? ''),
            'created_at' => $createdAt,
        ];
    }
}
