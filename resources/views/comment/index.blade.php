  <div id="auth-user" data-user-id="{{ auth()->id() }}"></div>

  <!-- Commentaires -->
  <div class="mb-8" x-data="comments({ type: '{{ $type }}', id: {{ $CommentableId }} })">
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

      <!-- Modal de signalement -->
      <template x-if="showReport">
          <div
              class="fixed inset-0 bg-gray-800 bg-opacity-70 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
              <div class="relative mx-auto my-16 p-0 w-full max-w-md" @click.outside="showReport = false">
                  <!-- Conteneur du modal -->
                  <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                      <!-- En-tête -->
                      <div class="bg-gradient-to-r from-green-600 to-indigo-700 p-6 text-white">
                          <div class="flex items-center justify-between">
                              <div class="flex items-center">
                                  <div class="bg-white bg-opacity-20 p-3 rounded-full mr-4">
                                      <i class="fas fa-exclamation-triangle text-xl"></i>
                                  </div>
                                  <h3 class="text-xl font-semibold">Signaler ce commentaire</h3>
                              </div>
                              <button @click="showReport = false" class="text-white hover:text-gray-200">
                                  <i class="fas fa-times text-lg"></i>
                              </button>
                          </div>
                      </div>

                      <!-- Formulaire -->
                      <form @submit.prevent = "reportComment()" class="px-6 py-5">
                          <input type="hidden" x-model="formReport.comment_id">

                          <!-- Sélecteur de catégorie -->
                          <div class="mb-5">
                              <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                  Catégorie
                              </label>
                              <div class="relative">
                                  <select x-model="formReport.category"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 appearance-none bg-white">
                                      <option value="spam">Spam</option>
                                      <option value="hate_speech">Discours haineux</option>
                                      <option value="inappropriate">Contenu inapproprié</option>
                                      <option value="harassment">Harcèlement</option>
                                      <option value="other" selected>Autre</option>
                                  </select>
                                  <div
                                      class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                      <i class="fas fa-chevron-down"></i>
                                  </div>
                              </div>
                          </div>

                          <!-- Raison du signalement -->
                          <div class="mb-5">
                              <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                                  Raison du signalement *
                              </label>
                              <textarea x-model="formReport.reason" rows="4" placeholder="Expliquez pourquoi vous signalez ce commentaire..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none"
                                  required></textarea>
                          </div>

                          <div id="reportErrors" x-show="Object.keys(errors).length > 0"
                              class="text-red-600 text-sm mb-4 bg-red-50 p-3 rounded-lg border border-red-200 flex items-start space-x-2">

                              <!-- Icône SVG -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-600"
                                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>

                              <!-- Messages d’erreur -->
                              <div>
                                  <template x-for="(messages, field) in errors" :key="field">
                                      <template x-for="message in messages" :key="message">
                                          <p x-text="message"></p>
                                      </template>
                                  </template>
                              </div>
                          </div>



                          <!-- Actions -->
                          <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                              <button type="button" @click="showReport = false"
                                  class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                  Annuler
                              </button>
                              <button type="submit"
                                  class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                  Signaler
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </template>

      <!-- Modal de confirmation de suppression -->
      <template x-if="showDeleteModal">
          <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
              <div class="bg-white rounded-lg shadow-xl p-6 m-4 max-w-md w-full">
                  <h3 class="text-xl font-bold text-gray-800 mb-2">Supprimer le commentaire ?</h3>
                  <p class="text-gray-600 mb-2">Cette action est irréversible.</p>
                  <p class="text-red-500 text-sm mb-4">Le commentaire sera définitivement supprimé.</p>

                  <div class="flex justify-end space-x-3">
                      <button @click="cancelDelete()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                          Annuler
                      </button>
                      <button @click="confirmDelete()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                          Supprimer
                      </button>
                  </div>
              </div>
          </div>
      </template>
      <h2 class="text-xl font-bold mb-4 text-center text-primary">Commentaires</h2>

      <div class="mt-6 flex flex-col items-center gap-4 my-8">
          {{-- Si aucun commentaire --}}

          <template x-if="commentsList.length <= 0">
              <div x-cloak
                  class="w-full max-w-md text-center p-4 bg-white border border-dashed border-gray-300 rounded-lg shadow-sm">
                  <p class="text-gray-600 text-sm">Soyez le premier à commenter cet évènement</p>
              </div>
          </template>

          @auth
              <!-- Utilisateur connecté : bouton pour laisser un commentaire -->
              <button type="button" @click.stop="toggleComment()"
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
                  <div class="flex w-full flex-row items-start justify-start gap-3 p-2 ">
                      <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10 shrink-0"
                          :style="`background-image: url('${comment.user.avatar || '/images/default-avatar.svg'}')`">
                      </div>
                      <div class="flex h-full flex-1 flex-col items-start justify-start">
                          <div class="relative bg-gray-200 pb-2 px-4 w-full rounded-lg">
                              <div class="flex w-full flex-row items-center justify-between gap-x-3">
                                  <div class="flex items-center justify-between">
                                      <p class="text-[#1c0d0d] text-base font-bold leading-normal tracking-[0.015em] capitalize mr-2"
                                          x-text="comment.user.full_name"></p>
                                      <p class="text-green-600 text-xs font-normal leading-normal"
                                          x-text="comment.created_at">
                                      </p>
                                  </div>
                                  @auth
                                      <button @click="toogleMenu(comment)" @click.outside="comment.menuOn = false"
                                          type="button" aria-label="Ouvrir le menu" aria-haspopup="menu"
                                          aria-expanded="false"
                                          class="inline-flex items-center justify-center p-1 rounded-full bg-transparent text-gray-600 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-gray-400">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5"
                                              fill="currentColor" aria-hidden="true">
                                              <circle cx="5" cy="12" r="1.75"></circle>
                                              <circle cx="12" cy="12" r="1.75"></circle>
                                              <circle cx="19" cy="12" r="1.75"></circle>
                                          </svg>
                                      </button>
                                  @endauth
                              </div>
                              <p class="text-[#1c0d0d] text-base font-normal leading-normal break-all whitespace-normal "
                                  x-text="comment.content">
                              </p>
                              <div x-show="comment.menuOn"
                                  class="absolute right-0 top-8 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black/10 z-10">
                                  <div class="py-1">
                                      <!-- Supprimer -->
                                      <button x-show="comment.user_id == userId" @click="deleteComment(comment.id)"
                                          class="flex
                                          items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full">
                                          Supprimer
                                      </button>
                                      <button x-show="comment.user_id == userId" @click.stop="showUpdate(comment)"
                                          class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                          Modifier
                                      </button>
                                      <!-- Signaler -->
                                      <button x-show="comment.user_id !== userId"
                                          @click.stop="showRepostModal(comment)"
                                          class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                          Signaler
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div
                              class="flex w-full flex-row items-center justify-start gap-9 pt-2 text-[#1c0d0d] font-semibold leading-normal tracking-[0.015em]">
                              @auth

                                  <div @click.stop="replyComment(comment)"
                                      class="flex items-center gap-2 hover:text-gray-800 cursor-pointer ">
                                      <span class="text-sm  leading-normal">Répondre</span>
                                  </div>
                              @endauth
                              <template x-if="comment.reply > 0">
                                  <div>
                                      <div x-show="!comment.showReplies" @click="loadReplies(comment)"
                                          class="flex items-center gap-2 hover:text-gray-800 cursor-pointer ">
                                          <span class="text-sm  leading-normal">Voir les <span
                                                  x-text="comment.reply"></span> réponses</span>
                                      </div>
                                      <div x-show="comment.showReplies" @click="hideReply(comment)"
                                          class="flex items-center gap-2 hover:text-gray-800 cursor-pointer ">
                                          <span class="text-sm  leading-normal">Masquer les réponses</span>
                                      </div>
                                  </div>
                              </template>
                          </div>
                      </div>
                  </div>
                  <div class="ml-12 mt-3 space-y-3 border-l pl-4" x-show="comment.showReplies" x-transition>
                      <template x-for="reply in comment.replies ?? []" :key="reply.id">
                          <div class="flex w-full flex-row items-start justify-start gap-3 p-2 ">
                              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full w-10 shrink-0"
                                  :style="`background-image: url('${reply.user.avatar || '/images/default-avatar.svg'}')`">
                              </div>
                              <div class="flex h-full flex-1 flex-col items-start justify-start">
                                  <div class="relative bg-gray-200 pb-2 px-4 w-full rounded-lg">
                                      <div class="flex w-full flex-row items-center justify-between gap-x-3">
                                          <div class="flex items-center justify-between">
                                              <p class="text-[#1c0d0d] text-base font-bold leading-normal tracking-[0.015em] capitalize mr-2"
                                                  x-text="reply.user.full_name"></p>
                                              <p class="text-green-600 text-xs font-normal leading-normal"
                                                  x-text="reply.created_at">
                                              </p>
                                          </div>
                                          @auth
                                              <button @click="toogleMenu(reply)" @click.outside="reply.menuOn = false"
                                                  type="button" aria-label="Ouvrir le menu" aria-haspopup="menu"
                                                  aria-expanded="false"
                                                  class="inline-flex items-center justify-center p-1 rounded-full bg-transparent text-gray-600 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-gray-400">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                      class="h-5 w-5" fill="currentColor" aria-hidden="true">
                                                      <circle cx="5" cy="12" r="1.75"></circle>
                                                      <circle cx="12" cy="12" r="1.75"></circle>
                                                      <circle cx="19" cy="12" r="1.75"></circle>
                                                  </svg>
                                              </button>
                                          @endauth
                                      </div>
                                      <p class="text-[#1c0d0d] text-base font-normal leading-normal break-all whitespace-normal"
                                          x-text="reply.content">
                                      </p>
                                      <div x-show="reply.menuOn"
                                          class="absolute right-0 top-8 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black/10 z-10">
                                          <div class="py-1">
                                              <!-- Supprimer -->
                                              <button x-show="reply.user_id == userId"
                                                  @click="deleteComment(reply.id)"
                                                  class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full">
                                                  Supprimer
                                              </button>
                                              <button x-show="reply.user_id == userId" @click.stop="showUpdate(reply)"
                                                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                                  Modifier
                                              </button>
                                              <!-- Signaler -->
                                              <button x-show="reply.user_id !== userId"
                                                  @click.stop="showRepostModal(reply)"
                                                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                                  </svg>
                                                  Signaler
                                              </button>
                                          </div>
                                      </div>
                                  </div>
                                  <div
                                      class="flex w-full flex-row items-center justify-start gap-9 pt-2 text-[#1c0d0d] font-semibold leading-normal tracking-[0.015em]">
                                      @auth

                                          <div @click.stop="replyComment(reply)"
                                              class="flex items-center gap-2 hover:text-gray-800 cursor-pointer ">
                                              <span class="text-sm  leading-normal">Répondre</span>
                                          </div>
                                      @endauth
                                      <template x-if="reply.reply > 0">
                                          <div>
                                              <div x-show="!reply.showReplies" @click="loadReplies(reply, comment)"
                                                  class="flex items-center gap-2 hover:text-gray-800 cursor-pointer ">
                                                  <span class="text-sm  leading-normal">Voir les <span
                                                          x-text="reply.reply"></span> réponses</span>
                                              </div>
                                          </div>
                                      </template>
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
          <div @click.outside = "toggleComment()"
              class="fixed inset-x-0 bottom-0 z-50 bg-white shadow-lg rounded-t-2xl p-4 transition-all duration-300 transform translate-y-0 border-t border-gray-100">
              <!-- Header du pop-up -->
              <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg font-medium text-gray-900"
                      x-text="form.comment_id ? 'Modifier le commentaire' : 'Nouveau commentaire'">
                  </h3> <button @click="toggleComment()" class="text-gray-400 hover:text-gray-500">
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
