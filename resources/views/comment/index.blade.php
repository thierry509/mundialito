  <!-- Commentaires -->
  <div class="mb-8" x-data="comments({ type: 'game', id: {{ $game->id }} })">

      <template x-ref=spinner>
          <div class="relative flex justify-center items-center h-16 w-16">
              <div
                  class="absolute h-full w-full border-4 border-transparent border-t-yellow-500 border-r-yellow-500 rounded-full animate-spin">
              </div>
              <div
                  class="absolute h-3/4 w-3/4 border-4 border-transparent border-t-yellow-300 border-r-yellow-300 rounded-full animate-spin [animation-delay:0.2s]">
              </div>
              <div
                  class="absolute h-1/2 w-1/2 border-4 border-transparent border-t-yellow-200 border-r-yellow-200 rounded-full animate-spin [animation-delay:0.4s]">
              </div>
          </div>
      </template>
      <h2 class="text-xl font-bold mb-4 text-center text-primary">Commentaires</h2>

      <div class="mt-6 flex flex-col items-center gap-4 my-8">
          {{-- Si aucun commentaire --}}

          <template x-if="commentsList.length <= 0">
            <div class="w-full max-w-md text-center p-4 bg-white border border-dashed border-gray-300 rounded-lg shadow-sm">
                <p class="text-gray-600 text-sm">Soyez le premier à commenter cet évènement 🎉</p>
            </div>
        </template>

          @auth
              <!-- Utilisateur connecté : bouton pour laisser un commentaire -->
              <button type="button" @click="toggleComment()"
                  class="w-full max-w-xs flex justify-center items-center px-2 py-2 text-sm font-medium rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-all duration-200 border border-gray-200 shadow-xs hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
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


      <template x-ref="commentTemplate">
          <template x-for="comment in commentsList" :key="comment.id">
              <div class="">
                  <div class="flex w-full flex-row items-start justify-start gap-3 p-4 ">
                      <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10 shrink-0"
                      :style="`background-image: url('${comment.user.avatar || '/images/default-avatar.svg'}')`">
                      </div>
                      <div class="flex h-full flex-1 flex-col items-start justify-start">
                          <div class="flex w-full flex-row items-start justify-start gap-x-3">
                              <p class="text-[#1c0d0d] text-sm font-bold leading-normal tracking-[0.015em] capitalize"
                                  x-text="comment.user.full_name"></p>
                              <p class="text-secondary text-sm font-normal leading-normal" x-text="comment.created_at">
                              </p>
                          </div>
                          <p class="text-[#1c0d0d] text-sm font-normal leading-normal" x-text="comment.content">
                          </p>
                          <div class="flex w-full flex-row items-center justify-start gap-9 pt-2">
                              @auth

                                  <div @click="replyComment(comment)"
                                      class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                      <span class="text-sm font-normal leading-normal">Répondre</span>
                                  </div>
                              @endauth
                              <template x-if="comment.reply > 0">
                                  <div>
                                      <div x-show="!comment.showReplies" @click="loadReplies(comment)"
                                          class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                          <span class="text-sm font-normal leading-normal">Voir les <span
                                                  x-text="comment.reply"></span> réponses</span>
                                      </div>
                                      <div x-show="comment.showReplies" @click="hideReply(comment)"
                                          class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                          <span class="text-sm font-normal leading-normal">Masquer les réponses</span>
                                      </div>
                                  </div>
                              </template>
                              <div @click="deleteComment(comment.id)"
                                  class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                  <span class="text-sm font-normal leading-normal">Supprimer</span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="ml-12 mt-3 space-y-3 border-l pl-4" x-show="comment.showReplies" x-transition>
                      <template x-for="reply in comment.replies ?? []" :key="reply.id">
                          <div class="flex w-full flex-row items-start justify-start gap-3 p-4 ">
                              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10 shrink-0"
                                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB6x1KViKaBpx0-4Q4xYH9m09Y4XtTU-6qjtj9k8Ywh7FlghI8KGJ3bUvVkpgljId4vrZNdl-1uSEcDmptJ0zFAUI3_OBl8G-VRBUdybre7hzP3JrLgEZ2wP-nOD5FxIE9E6fCG4iH8CsOU3IP56wOG8qQs6OFBDI7JPqxH6E7hrdnp_S3xiYC9xsVwLlo7PCKpFpIP4YL0MtLY5YwJwkcUUNujI7D1WSVVmh0DRY2TfDQvYP3UmSzJCSK-94DPzsz2nOeO_s5Mg2Qt");'>
                              </div>
                              <div class="flex h-full flex-1 flex-col items-start justify-start">
                                  <div class="flex w-full flex-row items-start justify-start gap-x-3">
                                      <p class="text-[#1c0d0d] text-sm font-bold leading-normal tracking-[0.015em] capitalize"
                                          x-text="reply.user.full_name"></p>
                                      <p class="text-secondary text-sm font-normal leading-normal"
                                          x-text="reply.created_at">
                                      </p>
                                  </div>
                                  <p class="text-[#1c0d0d] text-sm font-normal leading-normal" x-text="reply.content">
                                  </p>
                                  <div class="flex w-full flex-row items-center justify-start gap-9 pt-2">
                                      @auth
                                          <div @click="replyComment(reply)"
                                              class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                              <span class="text-sm font-normal leading-normal">Répondre</span>
                                          </div>
                                      @endauth
                                      <template x-if="reply.reply > 0">
                                          <div x-show="!reply.showReplies" @click="loadReplies(reply, comment)"
                                              class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                              <span class="text-sm font-normal leading-normal">Voir les <span
                                                      x-text="reply.reply"></span> réponses</span>
                                          </div>
                                      </template>
                                      <div @click="deleteComment(reply.id)"
                                          class="flex items-center gap-2 text-secondary hover:text-gray-800 cursor-pointer">
                                          <span class="text-sm font-normal leading-normal">Supprimer</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </template>
                  </div>
              </div>
          </template>
      </template>

      <div x-data="commentsList">
          <div x-html="$refs.commentTemplate.innerHTML"></div>
      </div>
      <div x-show="isLoading" class="w-full h-64 flex justify-center items-center ">
          <div x-html="$refs.spinner.innerHTML"></div>
      </div>

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
                          class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                          Publier
                      </button>
                  </div>
              </form>

          </div>
      </template>
  </div>
