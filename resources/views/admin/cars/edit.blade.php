@extends('layouts.admin')

@section('title', 'Modifier la Voiture - VoiturePro Admin')

@section('content')
    <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 text-white py-8 px-6 shadow-lg">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black mb-2 uppercase tracking-tighter">Modifier le Véhicule</h1>
                <p class="text-blue-100 italic">Mise à jour de la fiche technique : {{ $car->marque }} {{ $car->modele }}</p>
            </div>
            <div class="text-6xl opacity-20 hidden md:block">
                <i class="fas fa-car-side"></i>
            </div>
        </div>
    </div>

    <section class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('admin.cars.update', $car->id) }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-r-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Veuillez corriger les erreurs suivantes :</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Marque <span class="text-red-500">*</span></label>
                        <input type="text" name="marque" value="{{ old('marque', $car->marque) }}" required class="w-100 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Modèle <span class="text-red-500">*</span></label>
                        <input type="text" name="modele" value="{{ old('modele', $car->modele) }}" required class="w-100 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Année</label>
                        <input type="number" name="annee" value="{{ old('annee', $car->annee) }}" class="w-100 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kilométrage (km)</label>
                        <input type="number" name="kilometrage" value="{{ old('kilometrage', $car->kilometrage) }}" class="w-100 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Boîte de vitesses</label>
                        <select name="boite" class="w-100 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-white">
                            <option value="Manuelle" {{ $car->boite == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                            <option value="Automatique" {{ $car->boite == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                        </select>
                    </div>
                </div>

                <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                    <label class="block text-sm font-bold text-blue-900 mb-2">Prix de vente souhaité <span class="text-red-500">*</span></label>
                    <div class="relative flex items-center">
                        <input type="number" 
                               name="prix" 
                               value="{{ old('prix', $car->prix) }}" 
                               min="0" 
                               step="1000" 
                               required 
                               class="w-full p-4 border-2 border-blue-300 rounded-lg text-2xl font-bold text-blue-800 focus:border-blue-500 focus:ring-0 outline-none pr-20">
                        <span class="absolute right-4 text-xl font-black text-blue-400">FCFA</span>
                    </div>
                    <p class="mt-2 text-xs text-blue-600 font-medium italic">
                        <i class="fas fa-info-circle mr-1"></i> Conseil : Le prix actuel affiché est de {{ number_format($car->prix, 0, ',', ' ') }} FCFA.
                    </p>
                </div>

                @if($car->images && $car->images->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-blue-600"></i> Galerie Photos Actuelle
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($car->images as $image)
                            <div class="group relative aspect-video rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                @if($image->is_primary)
                                    <div class="absolute top-2 left-2 bg-green-500 text-white text-[10px] px-2 py-1 rounded font-bold uppercase">Principal</div>
                                @endif
                                <button type="button" 
                                        onclick="confirm('Supprimer cette photo ?') ? document.getElementById('delete-img-{{$image->id}}').submit() : null"
                                        class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-trash-alt text-white text-xl"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-10">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ajouter de nouvelles photos</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-blue-400 transition-colors cursor-pointer bg-gray-50 relative">
                        <input type="file" name="images[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-sm text-gray-500">Cliquez ou glissez-déposez vos photos ici</p>
                        <p class="text-[10px] text-gray-400 uppercase mt-1">PNG, JPG (Max. 2MB par photo)</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 border-t border-gray-100 pt-8">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-lg transition-all shadow-md active:transform active:scale-95 uppercase tracking-wide">
                        <i class="fas fa-check-circle mr-2"></i> Mettre à jour la fiche
                    </button>
                    <a href="{{ route('admin.cars.index') }}" class="sm:w-1/3 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-lg transition-all uppercase text-sm flex items-center justify-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </section>

    @foreach($car->images as $image)
        <form id="delete-img-{{$image->id}}" action="{{ route('admin.cars.deleteImage', $image->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    <style>
        .w-100 { width: 100%; }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
@endsection