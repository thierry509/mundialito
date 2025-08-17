/**
 * apiFetch - wrapper fetch pour GET/POST/PUT/DELETE avec JSON/FormData, params et timeout.
 *
 * @param {string} url - URL de la requête (peut contenir le chemin seulement).
 * @param {Object} options
 *   - method: 'GET'|'POST'|'PUT'|'DELETE' (default 'GET')
 *   - data: JavaScript object (sera JSON.stringified) ou FormData (passé tel quel)
 *   - params: object -> transformé en query string
 *   - headers: object d'en-têtes supplémentaires
 *   - timeout: ms avant abort (0 = pas de timeout)
 * @returns {Promise<{ok:boolean, status:number, headers:Headers, data:any}>}
 */
export async function apiFetch(url, {
    method = 'GET',
    data = null,
    params = null,
    headers = {},
    timeout = 0,
  } = {}) {
    // Construire query string si params fournis
    let fullUrl = url;
    if (params && typeof params === 'object') {
      const qs = new URLSearchParams();
      Object.entries(params).forEach(([k, v]) => {
        if (v === undefined || v === null) return;
        // si tableau -> ajouter plusieurs fois la clé
        if (Array.isArray(v)) v.forEach(item => qs.append(k, item));
        else qs.append(k, String(v));
      });
      const q = qs.toString();
      if (q) fullUrl += (fullUrl.includes('?') ? '&' : '?') + q;
    }
  
    const controller = new AbortController();
    let timeoutId;
    if (timeout > 0) {
      timeoutId = setTimeout(() => controller.abort(), timeout);
    }
  
    const fetchOptions = {
      method: method.toUpperCase(),
      headers: { Accept: 'application/json', ...headers },
      signal: controller.signal,
    };
  
    // body pour POST/PUT/PATCH/DELETE (si fourni)
    if (fetchOptions.method !== 'GET' && fetchOptions.method !== 'HEAD' && data != null) {
      if (data instanceof FormData) {
        // laisser le Content-Type à fetch (multipart/form-data avec boundary)
        fetchOptions.body = data;
      } else {
        // JSON par défaut
        if (!fetchOptions.headers['Content-Type'] && !fetchOptions.headers['content-type']) {
          fetchOptions.headers['Content-Type'] = 'application/json';
        }
        fetchOptions.body = JSON.stringify(data);
      }
    }
  
    try {
      const res = await fetch(fullUrl, fetchOptions);
  
      // parse body selon content-type
      const contentType = res.headers.get('content-type') || '';
      let parsed;
      if (contentType.includes('application/json')) {
        parsed = await res.json();
      } else {
        parsed = await res.text();
      }
  
      return {
        ok: res.ok,
        status: res.status,
        headers: res.headers,
        data: parsed
      };
    } catch (err) {
      // fetch error (network, abort, CORS, etc.)
      if (err.name === 'AbortError') {
        throw new Error(`Request aborted${timeout > 0 ? ' (timeout)' : ''}`);
      }
      throw err;
    } finally {
      if (timeoutId) clearTimeout(timeoutId);
    }
  }
  
  /* -- Helpers pour ergonomie -- */
  const api = {
    get: (url, opts = {}) => apiFetch(url, { ...opts, method: 'GET' }),
    post: (url, data, opts = {}) => apiFetch(url, { ...opts, method: 'POST', data }),
    put: (url, data, opts = {}) => apiFetch(url, { ...opts, method: 'PUT', data }),
    del: (url, data = null, opts = {}) => apiFetch(url, { ...opts, method: 'DELETE', data }),
  };
  