export function formatDate(dateString) {
    const date = new Date(dateString.replace(' ', 'T') + 'Z');

    const options = {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    };

    const formatter = new Intl.DateTimeFormat('fr-FR', options);
    const formattedDate = formatter.format(date);

    return formattedDate.replace(/,/g, ' •');
}
export function gameStatus(status) {
    const translations = {
        'soon': 'Bientôt',
        'live': 'En direct',
        'postponed': 'Reporté',
        'finished': 'Terminé'
    };
    return translations[status] || status;
}

/**
* Extrait la date et l'heure d'une chaîne datetime
* @param {string} strDateTime - Chaîne au format "YYYY-MM-DD HH:MM:SS"
* @returns {Object} - { date: "YYYY-MM-DD", time: "HH:MM" }
*/
export function dateTime(strDateTime) {
    if (!strDateTime || typeof strDateTime !== 'string') {
        throw new Error('Input must be a non-empty string');
    }

    // Séparation date et heure
    const [datePart, timePart] = strDateTime.split(' ');

    if (!datePart || !timePart) {
        throw new Error('Invalid datetime format. Expected "YYYY-MM-DD HH:MM:SS"');
    }

    // Validation rapide du format
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
    const timeRegex = /^\d{2}:\d{2}/; // On prend juste HH:MM

    if (!dateRegex.test(datePart)) {
        throw new Error('Invalid date format. Expected YYYY-MM-DD');
    }

    // Extraction de l'heure (juste HH:MM)
    const timeValue = timePart.match(timeRegex)?.[0];
    if (!timeValue) {
        throw new Error('Invalid time format. Expected HH:MM:SS');
    }

    return {
        date: datePart,
        time: timeValue
    };
}
