export function formatDate(dateString) {
    const isoString = dateString.includes('T') ? dateString : dateString.replace(' ', 'T') + 'Z';
    const date = new Date(isoString);

    if (isNaN(date.getTime())) {
        console.error('Date invalide:', dateString);
        return 'Date invalide';
    }

    const options = {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
        timeZone: 'UTC' // Ajoutez ceci si vous voulez afficher l'heure UTC
    };

    const formatter = new Intl.DateTimeFormat('fr-FR', options);
    let formattedDate = formatter.format(date);

    // Formatage personnalisé pour remplacer la virgule
    formattedDate = formattedDate.replace(/,/g, ' •');

    // Correction supplémentaire pour l'heure
    formattedDate = formattedDate.replace(/(\d{2})h(\d{2})/, '$1:$2');

    return formattedDate;
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

export function roles(role) {
    const translations = {
        'admin': 'Administrateur',
        'editor': 'Editeur',
        'reporter': 'Jornaliste',
        'user': 'Utilisateur'
    };
    return translations[role] || role;
}
export function gameStage(stage) {
    const translations = {
        '1': 'Première journée',
        '2': 'Deuxième journée',
        '3': 'Troisième journée',
        '4': 'Quatrième journee',
        'round16': 'Huitièmes de finale',
        'quarter': 'Quarts de finale',
        'semi': 'Demi-finales',  // Note: "semi" corrigé en "demi"
        'final': 'Finale',
    };
    return translations[stage] || stage;
}

/**
* Extrait la date et l'heure d'une chaîne datetime
* @param {string} strDateTime - Chaîne au format "YYYY-MM-DD HH:MM:SS"
* @returns {Object} - { date: "YYYY-MM-DD", time: "HH:MM" }
*/
export function dateTime(strDateTime) {
    if (!strDateTime || typeof strDateTime !== 'string') {
        return {
            date: null,
            time: null,
        };
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


export function statusClass(status) {
    const statusMap = {
        'soon': 'bg-blue-100 text-blue-800',
        'live': 'bg-red-100 text-red-800 animate-pulse',
        'postponed': 'bg-amber-100 text-amber-800',
        'finished': 'bg-green-100 text-green-800',
        // Valeur par défaut si le status est inconnu
        'default': 'bg-gray-100 text-gray-800'
    };

    return statusMap[status] || statusMap.default;
}


export function getValueKnockout(count, n) {
    // Vérification des paramètres
    if (n < 1 || n > count) return undefined;

    // Définition des séquences
    const sequences = {
        8: [-346, -246, -146, -50, 50, 146, 246, 346],
        4: [-146, -50, 50, 146],
        2: [-50, 50]
    };

    // Retourne la valeur correspondante
    return sequences[count]?.[n - 1];
}

function getValueKnockout2(totalElements, currentPosition) {
    const sequences = {
        8: [-346, -246, 146, -50, 50, 146, 246, 346],
        4: [146, -50, 50, 146],
        2: [-50, 50],
        4: [-300, -100, 100, 300]  // Nouvelle séquence pour 4 éléments
    };

    // Vérification des paramètres
    if (currentPosition < 1 || currentPosition > totalElements) return null;

    // Retourne la valeur correspondante
    return sequences[totalElements]?.[currentPosition - 1];
}


function getValueKnockout3(totalElements, currentPosition) {
    const sequences = {
        2: [-200, 200],
    };

    // Vérification des paramètres
    if (currentPosition < 1 || currentPosition > totalElements) return null;

    // Retourne la valeur correspondante
    return sequences[totalElements]?.[currentPosition - 1];
}

export function drawRound16(m, ctx, n) {
    const count = 8;

    ctx.save();
    ctx.translate(0, 0)

    // ctx.beginPath();
    // ctx.moveTo(230, 0);
    // ctx.lineTo(330, m);
    // ctx.closePath();
    // ctx.stroke();

    for (let i = 1; i <= count; i++) {

        let p = getValueKnockout(count, i);
        ctx.beginPath();
        ctx.moveTo(230, m - p);
        ctx.lineTo(300, m - p);
        ctx.closePath();
        ctx.stroke();


        ctx.beginPath();
        ctx.moveTo(300, m - p);
        if (i % 2 != 0) {
            ctx.lineTo(300, m - p - 50);
        }
        else {
            ctx.lineTo(300, m - p + 50);
        }
        ctx.closePath();
        ctx.stroke()

        ctx.beginPath()
        if (i % 2 != 0) {

            ctx.moveTo(300, m - p - 50);
            ctx.lineTo(370, m - p - 50);
        }
        ctx.closePath();
        ctx.stroke();
    }
    ctx.restore(); // Restaure le contexte

}

export function drawQuarter(m, ctx, n) {
    const count = 4;

    ctx.save();
    if (n == 1) {
        ctx.translate(0, 0)
    } else if (n == 2) {
        ctx.translate(340, 0)
    }


    for (let i = 1; i <= count; i++) {

        let p = getValueKnockout2(count, i);
        ctx.beginPath();
        ctx.moveTo(230, m - p);
        ctx.lineTo(300, m - p);
        ctx.closePath();
        ctx.stroke();


        ctx.beginPath();
        ctx.moveTo(300, m - p);
        if (i % 2 == 0) {
            ctx.lineTo(300, m - p + 150);
        }
        else {
            ctx.lineTo(300, m - p - 150);
        }
        ctx.closePath();
        ctx.stroke()

        ctx.beginPath()
        if (i % 2 != 0) {

            ctx.moveTo(300, m - p - 100);
            ctx.lineTo(370, m - p - 100);
        }
        ctx.closePath();
        ctx.stroke();
    }
    ctx.restore(); // Restaure le contexte

}

export function drawSemi(m, ctx, n) {
    const count = 2;

    ctx.save();
    if (n == 1) {
        ctx.translate(0, 0)
    } else if (n == 2) {
        ctx.translate(340, 0)
    } else if (n == 3) {
        ctx.translate(680, 0)
    }


    ctx.moveTo(230, m - 200);
    ctx.lineTo(300, m - 200);
    ctx.closePath();
    ctx.stroke();

    ctx.moveTo(230, m + 200);
    ctx.lineTo(300, m + 200);
    ctx.closePath();
    ctx.stroke();


    for (let i = 1; i <= count; i++) {

        let p = getValueKnockout3(count, i);
        ctx.beginPath();
        ctx.moveTo(230, m - p);
        ctx.lineTo(300, m - p);
        ctx.closePath();
        ctx.stroke();


        ctx.beginPath();
        ctx.moveTo(300, m - p);
        if (i % 2 == 0) {
            ctx.lineTo(300, m - p + 300);
        }
        else {
            ctx.lineTo(300, m - p - 300);
        }
        ctx.closePath();
        ctx.stroke()

        ctx.beginPath()
        if (i % 2 != 0) {
            ctx.moveTo(300, m - p - 200);
            ctx.lineTo(370, m - p - 200);
        }
        ctx.closePath();
        ctx.stroke();
    }
    ctx.restore(); // Restaure le contexte

}
