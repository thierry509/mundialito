@extends('layout.app')

@section('content')
    <!-- Hero Section -->
    <x-hero title="À Propos du Mundialito" subtitle="Découvrez l'histoire et l'esprit de notre tournoi"
        backgroundImage="/images/about-hero.jpg" variant="primary" haveYear="{{ false }}" :center="false" />

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- History Section -->
        <section class="mb-16 max-w-6xl mx-auto px-4">
            <div class="relative">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 text-center mb-4">
                    L'histoire du <span class="text-primary">Mundialito</span>
                </h2>
                
                <!-- Première image flottante à gauche -->
                <div class="float-right w-full sm:w-1/3 pr-0 sm:pr-6 ml-8 mt-4 mb-8 sm:mb-0">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary to-accent rounded-2xl opacity-50 group-hover:opacity-75 blur-lg transition duration-200"></div>
                        <div class="relative h-full rounded-2xl overflow-hidden">
                            <x-picture 
                                imageName="match-de-football-mondialito-parc-vincent-des-gonaives"
                                alt="Match de football mondialito parc vincent des gonaives" 
                                mobilePath="images/mobile/"
                                desktopPath="images/" 
                                loading="lazy"
                                class="w-full h-auto object-cover transition duration-500 group-hover:scale-105" />
                        </div>
                    </div>
                </div>
                
                <div class="prose max-w-none text-gray-600 text-justify text-lg leading-relaxed">
                    <h3 class="font-bold text-3xl mt-4 text-primary">Creation</h3>
                    <p class="text-lg leading-relaxed">
                        Le <em>championnat de football des vacances d'été</em> aux Gonaïves, connu sous le nom de <em>Mundialito</em>, est né en 1966 grâce à Mme <em>Antoinette Jean Louis dite Tisò</em>. Il visait à promouvoir les activités sportives dans le quartier populaire de <em>Raboteau</em>, en particulier dans la zone de bidonville près de la <em>Cité de l'Indépendance</em>. Ce tournoi portait le nom de <em>Coupe Jacky Ti Sò</em>, en hommage à son fils décédé, <em>Jacky Jean Noël</em>, et symbolisait pour elle une façon de transformer la douleur en action sociale.
                    </p>
                    
                    <p>
                        Ce championnat s'adressait aux jeunes de <em>moins de 13 ans (U-13)</em> et devint rapidement un pilier de la vie communautaire, réunissant passion, rivalité et solidarité. Le <em>terrain de Rénovation</em>, qui devait être détruit dans un projet d'urbanisation initié par <em>François Duvalier</em>, devint finalement un <em>lieu mythique</em> du football local grâce à la Coupe Jacky Ti Sò, freinant les démolitions prévues à Raboteau.
                    </p>
                                        
                    
                    <p>
                        Parmi les éditions les plus marquantes figure celle où l'équipe <em>Toison d'Or</em> de Pierre Saint Armand, composée de jeunes très soudés, affronta <em>Tchaker</em>, grand favori du tournoi, dirigée par des légendes locales comme <em>Trujillo, Zizi, Gracia Jean Charles</em> et <em>Manno Beaugé</em>. Contre toute attente, malgré les pronostics en leur défaveur, Toison d'Or triompha dans une ambiance féroce, appuyée par une mystérieuse prédiction de <em>Marco</em>, un personnage fantasque qui avait annoncé la victoire des "Trois Zombis".
                    </p>
                    
                    <p>
                        Ce championnat fut donc bien plus qu'un simple tournoi : c'était un <em>rituel social, une échappatoire pour la jeunesse, un espace d'espoir, de mémoire et d'identité</em> pour le quartier de Raboteau. Il a mêlé <em>football, culture populaire, spiritualité et résistance urbaine</em>, et reste un héritage vivant pour toute une génération. Ce championnat restera dans les mémoires comme une leçon : <em>l'unité, la foi et l'esprit d'équipe</em> peuvent triompher face à la force brute et aux statistiques.
                    </p>
                    
                    <h3 class="font-bold text-3xl mt-4 text-primary">L'appelation du mundialito</h3>
                    <p>
                        Le championnat d'été des Gonaïves a connu une montée spectaculaire grâce à la couverture médiatique de journalistes influents comme <em>Belfond Pierre</em> de Radio Lumière et <em>Claude Valbrun</em> de Radio Soleil. Profitant de l'engouement populaire, ils ont su présenter cette compétition locale sous un jour favorable, attirant ainsi l'attention <em>nationale</em>. Leurs reportages, diffusés <em>un mois avant le lancement officiel</em>, ont contribué à créer une véritable ambiance autour du tournoi, en donnant la parole aux dirigeants d'équipes et aux membres du comité organisateur.
                    </p>
                    
                    <p>
                        Quelques mois avant le Mondial, le Brésil avait déjà montré l'étendue de son talent dans un tournoi préliminaire appelé <em>le Mundialito</em>, organisé en Espagne à la fin de 1981. Ce nom avait fortement résonné jusque dans les rues de <em>Gonaïves</em>, tant l'engouement pour cette équipe était grand.
                    </p>
                    
                    <p>
                        Quand la Coupe du monde 1982 débuta, du 13 juin au 11 juillet, toute la ville vibrait au rythme des matchs. Des correspondants comme <em>Dieusel Dieufort Placide</em>, dépêchés par les radios de la capitale, permettaient au public haïtien de <em>vivre chaque instant de cette aventure planétaire avec émotion et ferveur</em>.
                    </p>
                    
                    <p>
                        L'impact fut tel que des <em>rumeurs circulaient</em> : le gouvernement de <em>Jean Claude Duvalier</em> aurait envisagé d'envoyer des émissaires aux Gonaïves pour rencontrer les responsables du championnat. Face à cette notoriété soudaine, <em>Jacky Jean Noël</em>, l'homme derrière le tournoi, s'est entouré de figures locales influentes : <em>Dr Frantz Jean Charles, Gracia Jacques, Gérard Jospitre, Ernst Démésier, Michel Fortuné, Gessy Lionel Joseph, Claude Valbrun, Franck Arthus, Dr Amisial, Elie Cantave dit Pil, Clairmond Numa, Maurice Pepit</em>, entre autres. Leur soutien fut décisif pour faire du <em>Mundialito</em> un événement majeur.
                    </p>
                    
                    <p class="italic mt-8">
                        Inspiré du livre <strong>Le football aux Gonaïves à travers le temps</strong> de Joanes Clairzius.
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
