<?php

/**
 * Formate une date selon le format français
 * @param string $dateString Date au format "YYYY-MM-DD HH:MM:SS"
 * @return string Date formatée (ex: "10 janv. 2023 • 14:30")
 */
function formatDate($dateString) {
    $date = new DateTime(str_replace(' ', 'T', $dateString) . 'Z');

    $formatter = new IntlDateFormatter(
        'fr_FR',
        IntlDateFormatter::SHORT,
        IntlDateFormatter::SHORT,
        'UTC',
        IntlDateFormatter::GREGORIAN,
        "d MMM yyyy • HH:mm"
    );

    return $formatter->format($date);
}

/**
 * Traduit le statut d'un match
 * @param string $status Statut original (soon, live, etc.)
 * @return string Statut traduit
 */
function gameStatus($status) {
    $translations = [
        'soon' => 'Bientôt',
        'live' => 'En direct',
        'postponed' => 'Reporté',
        'finished' => 'Terminé'
    ];

    return $translations[$status] ?? $status;
}

/**
 * Traduit la phase d'un match
 * @param string $stage Phase du match
 * @return string Phase traduite
 */
function gameStage($stage) {
    $translations = [
        '1' => 'Première journée',
        '2' => 'Deuxième journée',
        '3' => 'Troisième journée',
        '4' => 'Quatrième journée',
        'round16' => 'Huitièmes de finale',
        'quarter' => 'Quarts de finale',
        'semi' => 'Demi-finales',
        'final' => 'Finale'
    ];

    return $translations[$stage] ?? $stage;
}

/**
 * Extrait la date et l'heure d'une chaîne datetime
 * @param string $strDateTime Chaîne au format "YYYY-MM-DD HH:MM:SS"
 * @return array Tableau avec 'date' et 'time'
 * @throws Exception Si le format est invalide
 */
function dateTime($strDateTime) {
    if (!is_string($strDateTime) || empty($strDateTime)) {
        return [
            'date' => null,
            'time' => null
        ];
    }

    // Séparation date et heure
    $parts = explode(' ', $strDateTime);

    if (count($parts) < 2) {
        throw new Exception('Format datetime invalide. Attendu "YYYY-MM-DD HH:MM:SS"');
    }

    $datePart = $parts[0];
    $timePart = $parts[1];

    // Validation du format date
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datePart)) {
        throw new Exception('Format de date invalide. Attendu YYYY-MM-DD');
    }

    // Extraction de l'heure (HH:MM)
    if (!preg_match('/^(\d{2}:\d{2})/', $timePart, $matches)) {
        throw new Exception('Format d\'heure invalide. Attendu HH:MM:SS');
    }

    return [
        'date' => $datePart,
        'time' => $matches[1]
    ];
}

/**
 * Retourne les classes CSS en fonction du statut
 * @param string $status Statut du match
 * @return string Classes CSS
 */
function statusClass($status) {
    $statusMap = [
        'soon' => 'bg-blue-100 text-blue-800',
        'live' => 'bg-red-100 text-red-800',
        'postponed' => 'bg-amber-100 text-amber-800',
        'finished' => 'bg-green-100 text-green-800',
        'default' => 'bg-gray-100 text-gray-800'
    ];

    return $statusMap[$status] ?? $statusMap['default'];
}
