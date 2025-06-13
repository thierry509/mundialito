  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12 overflow-hidden">
      <div class="max-w-7xl px-6 md:px-12 mx-auto sm:px-6">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
              <div class="md:col-span-2">
                  <h3 class="text-2xl font-bold mb-4">Mundialito Gonaïves</h3>
                  <p class="text-light">
                      Le championnat de football estival le plus passionnant de la région.
                      Rejoignez-nous pour célébrer le sport, la jeunesse et la communauté.
                  </p>
              </div>
              <div>
                  <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                  <ul class="space-y-2">
                      <li><a href="{{ route('home') }}" class="text-light hover:text-secondary transition">Accueil</a>
                      </li>
                      <li><a href="{{ route('games') }}"
                              class="needsYear text-light hover:text-secondary transition">Match</a>
                      </li>
                      <li><a href="{{ route('groups') }}"
                              class="needsYear text-light hover:text-secondary transition">classement</a>
                      </li>
                      <li><a href="{{ route('knockout') }}"
                              class="needsYear text-light hover:text-secondary transition">Elimination</a>
                      </li>
                      <li><a href="{{ route('about') }}" class="needsYear text-light hover:text-secondary transition">À
                              propos</a></li>
                      <li><a href="{{ route('news') }}"
                              class="text-light hover:text-secondary transition">Actualités</a></li>

                      <li><a href="{{ route('prize-list') }}"
                              class="text-light hover:text-secondary transition">Palmarès</a></li>
                      <li><a href="{{ route('cgu') }}" class="text-light hover:text-secondary transition">Conditions
                              d'utilisation</a></li>
                  </ul>
              </div>
              <div>
                  <h4 class="text-lg font-semibold mb-4">Contact</h4>
                  <ul class="space-y-2">
                      {{-- <li class="flex items-center text-light">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                              </path>
                          </svg>
                          +509 00 00 0000
                      </li>
                      <li class="flex items-center text-light">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                              </path>
                          </svg>
                          contact@Mundialitogonaives.com
                      </li> --}}
                      <li class="flex items-center text-light">
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                              </path>
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          </svg>
                          Gonaïves, Haïti
                      </li>
                  </ul>
              </div>
          </div>
          <div class="border-t border-light border-opacity-20 mt-8 pt-8 text-center text-light">
              <p>&copy; 2025 Mundialito. Tous droits réservés.</p>
          </div>
      </div>
  </footer>
  <script defer>
      const yearSelect = document.querySelector('#selectYear');
      const storageKey = 'year-store';

      try {
          // Récupérer l'année stockée
          const store = sessionStorage.getItem(storageKey);
          const storedYear = JSON.parse(store)?.year
          updateLinksWithYear(storedYear)
      } catch (e) {
          console.error(e)
      }

      function updateLinksWithYear(year) {

          // Sélectionner tous les liens de la page
          const allLinks = document.querySelectorAll('.needsYear');

          allLinks.forEach(link => {
              // Ne pas modifier les liens externes ou spéciaux
              if (link.hostname !== window.location.hostname ||
                  link.href.includes('javascript:') ||
                  link.href.includes('mailto:')) {
                  return;
              }

              // Créer un objet URL pour manipulation facile
              const url = new URL(link.href);

              // Ajouter ou mettre à jour le paramètre 'year'
              if (!year) {
                  year = {{ $years[0] }};
              }
              url.searchParams.set('year', year);

              // Mettre à jour le href du lien
              link.href = url.toString();
          });
      }
  </script>

  </body>

  </html>
