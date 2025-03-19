<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Les routes concernées par CORS
    'allowed_methods' => ['*'], // Méthodes HTTP autorisées
    'allowed_origins' => ['http://localhost:3000'], // Remplace par l'URL de ton frontend
    'allowed_headers' => ['*'], // En-têtes autorisés
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Important pour Sanctum
];
