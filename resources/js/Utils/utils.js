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
