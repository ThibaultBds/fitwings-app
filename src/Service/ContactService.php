<?php

namespace App\Service;

use App\Repositories\ContactMessageRepository;

class ContactService
{
    private ContactMessageRepository $contactMessageRepository;

    public function __construct(?ContactMessageRepository $contactMessageRepository = null)
    {
        $this->contactMessageRepository = $contactMessageRepository ?? new ContactMessageRepository();
    }

    public function sendMessage(
        string $nom,
        string $email,
        string $message,
        string $ip,
        string $userAgent
    ): array {
        if ($nom === '' || $email === '' || $message === '') {
            return ['success' => false, 'error' => 'Tous les champs sont obligatoires.'];
        }

        $safeEmail = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);
        $subject = sprintf('Message de %s via Fitwings', $nom);
        $body = "Nom : {$nom}\nEmail : {$email}\n\nMessage :\n{$message}";
        $headers = [
            'From: noreply@fitwings.fr',
            'Reply-To: ' . $safeEmail,
        ];

        $this->contactMessageRepository->create([
            'nom' => $nom,
            'email' => $email,
            'message' => $message,
            'ip' => $ip,
            'user_agent' => $userAgent,
        ]);

        $success = mail('contact@fitwings.fr', $subject, $body, implode("\r\n", $headers));

        if (!$success) {
            return ['success' => false, 'error' => "Le message n'a pas pu être envoyé pour le moment."];
        }

        return ['success' => true, 'error' => ''];
    }
}
