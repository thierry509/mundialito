  <!-- Commentaires -->
  <div class="mb-8" x-data="comments({ type: 'game', id: {{ $game->id }} })">
      <h2 class="text-xl font-bold mb-4 text-center text-primary">Commentaires</h2>

      <div class="mt-6 flex flex-col items-center gap-4 my-8">
          @auth
              <!-- Utilisateur connecté : bouton pour laisser un commentaire -->
              <button type="button" @click="toggleComment()"
                  class="w-full max-w-xs flex justify-center items-center px-2 py-2 text-sm font-medium rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-all duration-200 border border-gray-200 shadow-xs hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  aria-label="Laisser un commentaire">
                  Laisser un commentaire
              </button>
          @endauth

          @guest
              <!-- Utilisateur non connecté : message + bouton de connexion -->
              <div class="w-full max-w-xs flex flex-col items-center gap-3 p-4 bg-gray-50 rounded-lg text-center">
                  <p class="text-sm text-gray-600">Connectez-vous pour participer à la discussion.</p>
                  <a href="{{ route('login') }}"
                      class="w-full flex justify-center items-center px-4 py-2.5 text-sm font-medium bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900/50"
                      aria-label="Se connecter">
                      Se connecter
                  </a>
              </div>
          @endguest
      </div>
      <template x-for="comment in comments">
          <div class="flex w-full flex-row items-start justify-start gap-3 p-4 ">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10 shrink-0"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB6x1KViKaBpx0-4Q4xYH9m09Y4XtTU-6qjtj9k8Ywh7FlghI8KGJ3bUvVkpgljId4vrZNdl-1uSEcDmptJ0zFAUI3_OBl8G-VRBUdybre7hzP3JrLgEZ2wP-nOD5FxIE9E6fCG4iH8CsOU3IP56wOG8qQs6OFBDI7JPqxH6E7hrdnp_S3xiYC9xsVwLlo7PCKpFpIP4YL0MtLY5YwJwkcUUNujI7D1WSVVmh0DRY2TfDQvYP3UmSzJCSK-94DPzsz2nOeO_s5Mg2Qt");'>
              </div>
              <div class="flex h-full flex-1 flex-col items-start justify-start">
                  <div class="flex w-full flex-row items-start justify-start gap-x-3">
                      <p class="text-[#1c0d0d] text-sm font-bold leading-normal tracking-[0.015em] capitalize"
                          x-text="comment.user.full_name"></p>
                      <p class="text-secondary text-sm font-normal leading-normal" x-text="comment.created_at"></p>
                  </div>
                  <p class="text-[#1c0d0d] text-sm font-normal leading-normal" x-text="comment.content">
                  </p>
                  <div class="flex w-full flex-row items-center justify-start gap-9 pt-2">
                      <div class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                          <div class="" data-icon="ThumbsUp" data-size="20px" data-weight="regular">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor"
                                  viewBox="0 0 256 256">
                                  <path
                                      d="M234,80.12A24,24,0,0,0,216,72H160V56a40,40,0,0,0-40-40,8,8,0,0,0-7.16,4.42L75.06,96H32a16,16,0,0,0-16,16v88a16,16,0,0,0,16,16H204a24,24,0,0,0,23.82-21l12-96A24,24,0,0,0,234,80.12ZM32,112H72v88H32ZM223.94,97l-12,96a8,8,0,0,1-7.94,7H88V105.89l36.71-73.43A24,24,0,0,1,144,56V80a8,8,0,0,0,8,8h64a8,8,0,0,1,7.94,9Z">
                                  </path>
                              </svg>
                          </div>
                          <p class="text-sm font-normal leading-normal">12</p>
                      </div>
                      <div @click="replyComment(comment)"
                          class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                          <span class="text-sm font-normal leading-normal">Repondre</span>
                      </div>
                      <div @click="deleteComment(comment.id)"
                          class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                          <span class="text-sm font-normal leading-normal">Supprimer</span>
                      </div>
                  </div>
              </div>
          </div>
      </template>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <template x-if="isCommenting" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
          <div
              class="fixed inset-x-0 bottom-0 z-50 bg-white shadow-lg rounded-t-2xl p-4 transition-all duration-300 transform translate-y-0 border-t border-gray-100">
              <!-- Header du pop-up -->
              <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg font-medium text-gray-900">Nouveau commentaire</h3>
                  <button @click="toggleComment()" class="text-gray-400 hover:text-gray-500">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>

              <!-- Formulaire -->
              <form @submit.prevent="postComment()">
                  <!-- Zone de texte -->
                  <template x-if="form.parent_user">
                      <div class="mb-2 text-sm text-gray-600 flex items-center space-x-2">
                          <span>Répondre à</span>
                          <span class="font-semibold text-primary">@<span x-text="form.parent_user"></span></span>
                      </div>
                  </template>
                  <div class="mb-4">
                      <textarea rows="3" :placeholder="form.parent_id ? 'Votre réponse...' : 'Votre commentaire...'" name="content"
                          x-model="form.content"
                          class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary outline-none focus:border-transparent placeholder-gray-400 resize-none"></textarea>
                  </div>

                  <!-- Actions -->
                  <div class="flex justify-end space-x-3">
                      <button type="button" @click="toggleComment()"
                          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                          Annuler
                      </button>
                      <button type="submit"
                          class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                          Publier
                      </button>
                  </div>
              </form>

          </div>
      </template>
  </div>
