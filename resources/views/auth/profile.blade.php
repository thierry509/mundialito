@extends('layout.app')

@section('content')
    <!-- Hero Section avec le composant réutilisable -->
    <x-hero title="Profile" backgroundImage="/images/stade-resultats.jpg" variant="secondary" haveYear="{{ false }}" />

    @if ($errors->any())
        <ul class="max-w-4xl mx-auto my-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 space-y-2">
            @foreach ($errors->all() as $error)
                <li class="flex items-center gap-2">
                    <!-- Icône SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4
                                 c-.77-1.333-2.694-1.333-3.464 0L4.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ $error }}</span>
                </li>
            @endforeach
        </ul>
    @endif


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="profileData()">
        <div class="overflow-hidden">
            <div class="flex flex-col items-center" x-data="{
                preview: null,
                updatePreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.preview = URL.createObjectURL(file);
                    }
                }
            }">

                <!-- Image avec hover modern -->
                <div class="relative group">
                    <template x-if="preview">
                        <img :src="preview"
                            class="w-36 h-36 rounded-full object-cover shadow-lg ring-4 ring-green-500/30 transition duration-300" />
                    </template>

                    <template x-if="!preview">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}"
                                class="w-36 h-36 rounded-full object-cover shadow-lg ring-2 ring-gray-300 group-hover:ring-green-400 transition duration-300" />
                        @else
                            <div
                                class="w-36 h-36 rounded-full bg-gradient-to-r from-gray-300 to-gray-200 flex items-center justify-center shadow-lg">
                                <svg class="h-20 w-20 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="m 8 1 c -1.65625 0 -3 1.34375 -3 3 s 1.34375 3 3 3 s 3 -1.34375 3 -3 s -1.34375 -3 -3 -3 z m -1.5 7 c -2.492188 0 -4.5 2.007812 -4.5 4.5 v 0.5 c 0 1.109375 0.890625 2 2 2 h 8 c 1.109375 0 2 -0.890625 2 -2 v -0.5 c 0 -2.492188 -2.007812 -4.5 -4.5 -4.5 z m 0 0" />
                                </svg>
                            </div>
                        @endif
                    </template>

                    <!-- Overlay "changer" -->
                    <label for="avatar"
                        class="absolute inset-0 bg-black/50 flex items-center justify-center rounded-full text-white text-sm font-medium opacity-0 group-hover:opacity-100 cursor-pointer transition">
                        Changer
                    </label>
                </div>

                <!-- Formulaire -->
                <form method="POST" action="{{ route('avatar.update') }}" enctype="multipart/form-data"
                    class="mt-6 w-full max-w-xs">
                    @csrf
                    @method('put')
                    <input id="avatar" type="file" name="avatar" accept="image/*" class="hidden"
                        @change="updatePreview" />

                    <!-- Bouton visible seulement si une image est choisie -->
                    <button type="submit" x-show="preview" x-transition x-cloak
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-xl shadow-md hover:bg-green-700 transition font-medium">
                        Mettre à jour la photo
                    </button>
                </form>
            </div>


            <!-- Informations personnelles -->
            <div class="w-full bg-white rounded-xl shadow-md p-8">
                <h3 class="md:text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-100 flex justify-between">
                    Informations Personnelles
                    <button @click="toggleEditMode"
                        class="text-xs px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-300 flex items-center">
                        <template x-if="!editMode">
                            <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </template>
                        <template x-if="editMode">
                            <svg class="h-4 w-4 text-white" viewBox="0 0 512 512" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="currentColor">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>cancel</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="work-case" fill="currentColor" transform="translate(91.520000, 91.520000)">
                                            <polygon id="Close"
                                                points="328.96 30.2933333 298.666667 1.42108547e-14 164.48 134.4 30.2933333 1.42108547e-14 1.42108547e-14 30.2933333 134.4 164.48 1.42108547e-14 298.666667 30.2933333 328.96 164.48 194.56 298.666667 328.96 328.96 298.666667 194.56 164.48">
                                            </polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </template>
                        <span class="ml-2 hidden md:block" x-text="editMode ? 'Annuler' : 'Modifier le profil'"></span>
                    </button>
                </h3>

                <!-- Formulaire de modification du profil -->
                <form action="{{ route('profile.update') }}" method="POST" x-show="editMode" x-cloak>
                    @csrf
                    @method('PUT')
                    <div class="space-y-5">
                        <!-- Prénom et Nom -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Prénom</label>
                                <input name="first_name" type="text"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('first_name') input-error @enderror">
                                @error('first_name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Nom</label>
                                <input name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('last_name') input-error @enderror">
                                @error('last_name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                            <input name="phone" type="tel" value="{{ old('phone', $user->phone) }}"
                                placeholder="Ex: 509 40281374"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('phone') input-error @enderror">
                            @error('phone')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton principal -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition duration-300 shadow-md flex justify-center items-center gap-2">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>

                <!-- Affichage des informations en mode lecture -->
                <div x-show="!editMode" x-cloak>
                    <div class="space-y-5">
                        <!-- Prénom et Nom -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Prénom</label>
                                <p class="text-gray-800">{{ $user->first_name }}</p>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-gray-500">Nom</label>
                                <p class="text-gray-800">{{ $user->last_name }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-800">{{ $user->email }}</p>
                        </div>

                        <!-- Téléphone -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                            <p class="text-gray-800">{{ $user->phone ?? 'Non renseigné' }}</p>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="button" @click="editPassMode = true"
                            class="py-2 px-4 bg-gray-100 hover:bg-gray-200 text-green-600 rounded-lg font-medium transition duration-300 flex items-center justify-center gap-2">
                            <svg class="h-4 w-4 text-green-600" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg> Modifier le mot de passe
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour modifier le mot de passe -->
        <div x-show="editPassMode" x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6" @click.away="editPassMode = false">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Modifier le mot de passe</h3>
                    <button @click="editPassMode = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                            <input name="current_password" type="password"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('current_password') input-error @enderror">
                            @error('current_password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                            <input name="password" type="password" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('password') input-error @enderror">
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmer le nouveau mot de
                                passe</label>
                            <input name="password_confirmation" type="password" required
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="editPassMode = false"
                            class="px-4 py-2 border rounded-lg">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function profileData() {
            return {
                editMode: false,
                editPassMode: false,
                toggleEditMode() {
                    this.editMode = !this.editMode;
                }
            }
        }
    </script>
@endsection
