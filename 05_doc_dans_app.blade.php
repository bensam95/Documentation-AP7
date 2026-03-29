{{-- Copier ce fichier dans : resources/views/help.blade.php --}}
{{-- Ajouter la route dans routes/web.php : --}}
{{-- Route::middleware(['auth'])->get('/help', fn() => view('help'))->name('help'); --}}

@extends('layouts.app')
@section('title', 'Aide')

@section('content')
<div class="max-w-3xl">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-semibold text-slate-900">Documentation</h2>
            <p class="text-slate-500 text-sm mt-1">Guide d'utilisation de l'application</p>
        </div>
        <a href="{{ route('dashboard') }}"
           class="px-4 py-2 border border-slate-300 text-slate-600 text-sm rounded-lg hover:bg-slate-50 transition">
            Retour
        </a>
    </div>

    {{-- Sommaire --}}
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mb-8">
        <p class="text-sm font-semibold text-slate-700 mb-3">Sommaire</p>
        <ul class="space-y-1 text-sm">
            <li><a href="#demande-acces" class="text-blue-600 hover:underline">1. Demande d'acces</a></li>
            <li><a href="#connexion" class="text-blue-600 hover:underline">2. Connexion</a></li>
            <li><a href="#reservation" class="text-blue-600 hover:underline">3. Reserver une place</a></li>
            <li><a href="#file-attente" class="text-blue-600 hover:underline">4. File d'attente</a></li>
            <li><a href="#liberer" class="text-blue-600 hover:underline">5. Liberer une place</a></li>
            <li><a href="#profil" class="text-blue-600 hover:underline">6. Mon profil</a></li>
            <li><a href="#regles" class="text-blue-600 hover:underline">7. Regles importantes</a></li>
            <li><a href="#faq" class="text-blue-600 hover:underline">8. Questions frequentes</a></li>
        </ul>
    </div>

    {{-- Section 1 --}}
    <div id="demande-acces" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">1. Demande d'acces</h3>
        <p class="text-sm text-slate-600 mb-3">
            Si vous n'avez pas de compte, cliquez sur "Demander un acces" sur la page de connexion.
        </p>
        <ol class="text-sm text-slate-600 space-y-2 list-decimal list-inside">
            <li>Remplissez votre nom, email et mot de passe</li>
            <li>Le mot de passe doit avoir 14 caracteres minimum, une majuscule, une minuscule et un caractere special</li>
            <li>Envoyez votre demande</li>
            <li>Attendez la validation par l'administrateur avant de pouvoir vous connecter</li>
        </ol>
        <div class="mt-3 px-3 py-2 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg text-xs">
            Votre compte ne sera pas actif immediatement. Un administrateur doit valider votre demande.
        </div>
    </div>

    {{-- Section 2 --}}
    <div id="connexion" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">2. Connexion</h3>
        <p class="text-sm text-slate-600 mb-3">
            Saisissez votre email et mot de passe puis cliquez sur "Se connecter".
        </p>
        <div class="space-y-2">
            <div class="flex items-start gap-2 text-sm">
                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-xs rounded font-medium border border-amber-200 whitespace-nowrap">1ere erreur</span>
                <span class="text-slate-600">Delai de 30 secondes avant de reessayer</span>
            </div>
            <div class="flex items-start gap-2 text-sm">
                <span class="px-2 py-0.5 bg-orange-50 text-orange-700 text-xs rounded font-medium border border-orange-200 whitespace-nowrap">2eme erreur</span>
                <span class="text-slate-600">Delai de 45 secondes — attention, derniere tentative</span>
            </div>
            <div class="flex items-start gap-2 text-sm">
                <span class="px-2 py-0.5 bg-red-50 text-red-600 text-xs rounded font-medium border border-red-200 whitespace-nowrap">3eme erreur</span>
                <span class="text-slate-600">Compte verrouille — contactez l'administrateur</span>
            </div>
        </div>
    </div>

    {{-- Section 3 --}}
    <div id="reservation" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">3. Reserver une place</h3>
        <p class="text-sm text-slate-600 mb-3">
            Depuis votre tableau de bord, cliquez sur "Demander une place".
        </p>
        <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
            <li>Une place libre vous est attribuee immediatement et aleatoirement</li>
            <li>Vous ne pouvez pas choisir votre place</li>
            <li>La duree de reservation est fixee par l'administrateur</li>
            <li>Vous voyez le numero de votre place, la date de debut et la date d'expiration</li>
        </ul>
    </div>

    {{-- Section 4 --}}
    <div id="file-attente" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">4. File d'attente</h3>
        <p class="text-sm text-slate-600 mb-3">
            Si aucune place n'est disponible, vous etes automatiquement place en file d'attente.
        </p>
        <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
            <li>Vous voyez votre position dans la file (ex: #3)</li>
            <li>Une barre de progression indique votre avancement</li>
            <li>Des qu'une place se libere, elle vous est attribuee automatiquement</li>
            <li>Vous n'avez rien a faire — l'attribution est automatique</li>
        </ul>
        <div class="mt-3 px-3 py-2 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-xs">
            Vous ne pouvez pas faire de nouvelle demande si vous etes deja en file d'attente.
        </div>
    </div>

    {{-- Section 5 --}}
    <div id="liberer" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">5. Liberer une place</h3>
        <p class="text-sm text-slate-600 mb-3">
            Depuis votre tableau de bord, cliquez sur "Liberer ma place" puis confirmez.
        </p>
        <ul class="text-sm text-slate-600 space-y-1 list-disc list-inside">
            <li>Votre place est immediatement liberee</li>
            <li>Elle est automatiquement attribuee au premier en liste d'attente</li>
            <li>Si vous souhaitez une nouvelle place, vous devrez refaire une demande</li>
        </ul>
        <div class="mt-3 px-3 py-2 bg-red-50 border border-red-200 text-red-700 rounded-lg text-xs">
            Attention : cette action est irreversible. Une fois liberee, vous perdez votre place.
        </div>
    </div>

    {{-- Section 6 --}}
    <div id="profil" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">6. Mon profil</h3>
        <p class="text-sm text-slate-600 mb-3">
            Cliquez sur "Mon profil" dans la barre de navigation pour acceder a votre profil.
        </p>
        <p class="text-sm text-slate-600 mb-2">Vous pouvez modifier votre mot de passe :</p>
        <ol class="text-sm text-slate-600 space-y-1 list-decimal list-inside">
            <li>Saisissez votre mot de passe actuel</li>
            <li>Saisissez votre nouveau mot de passe (14 car. min., majuscule, minuscule, special)</li>
            <li>Confirmez le nouveau mot de passe</li>
            <li>Cliquez sur "Modifier le mot de passe"</li>
        </ol>
    </div>

    {{-- Section 7 --}}
    <div id="regles" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-3">7. Regles importantes</h3>
        <ul class="text-sm text-slate-600 space-y-2">
            <li class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                Les reservations sont toujours immediates — vous ne choisissez pas la date
            </li>
            <li class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                Les places sont attribuees aleatoirement — vous ne choisissez pas la place
            </li>
            <li class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                Une seule reservation active a la fois par utilisateur
            </li>
            <li class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                Impossible de faire une demande si vous etes en file d'attente
            </li>
            <li class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                Apres expiration, vous devez refaire une demande pour obtenir une place
            </li>
        </ul>
    </div>

    {{-- Section 8 --}}
    <div id="faq" class="bg-white rounded-xl border border-slate-200 p-6 mb-5">
        <h3 class="font-semibold text-slate-900 mb-4">8. Questions frequentes</h3>
        <div class="space-y-4">
            @foreach([
                ['q' => 'Puis-je choisir ma place ?', 'r' => 'Non. Les places sont attribuees aleatoirement parmi les places disponibles.'],
                ['q' => 'Puis-je reserver a l\'avance ?', 'r' => 'Non. Les reservations sont toujours immediates.'],
                ['q' => 'Que se passe-t-il quand ma reservation expire ?', 'r' => 'Votre place est automatiquement liberee. Vous devez refaire une demande pour une nouvelle place.'],
                ['q' => 'Mon compte est verrouille, que faire ?', 'r' => 'Contactez votre administrateur a admin@parking.fr pour qu\'il debloque votre compte.'],
                ['q' => 'Je n\'arrive pas a creer un mot de passe valide ?', 'r' => 'Votre mot de passe doit avoir 14 caracteres minimum avec une majuscule, une minuscule et un caractere special. Exemple : Parking2024!Abc'],
            ] as $item)
                <div class="border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                    <p class="text-sm font-medium text-slate-900 mb-1">{{ $item['q'] }}</p>
                    <p class="text-sm text-slate-500">{{ $item['r'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Contact --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 text-center">
        <p class="text-sm font-medium text-blue-900 mb-1">Besoin d'aide supplementaire ?</p>
        <p class="text-sm text-blue-700">Contactez votre administrateur : <strong>admin@parking.fr</strong></p>
    </div>

</div>
@endsection
