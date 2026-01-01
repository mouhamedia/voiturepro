@extends('layouts.admin')

@section('title', 'Ajouter une Voiture - VoiturePro Admin')

@section('content')
    <div class="bg-gradient-to-r from-brand-primary via-blue-600 to-brand-primary text-white py-8 px-6 shadow-lg">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-black mb-2 uppercase tracking-tighter">Ajouter une Voiture</h1>
                <p class="text-slate-100 italic">Enregistrez un nouveau véhicule dans votre parc automobile</p>
            </div>
            <div class="text-6xl opacity-20 hidden md:block">
                <i class="fas fa-plus-circle"></i>
            </div>
        </div>
    </div>

    <section class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-600 text-red-700 p-4 mb-8 rounded-r-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Erreurs détectées :</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Marque <span class="text-red-500">*</span></label>
                        <input type="text" name="marque" value="{{ old('marque') }}" placeholder="ex: Toyota" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Modèle <span class="text-red-500">*</span></label>
                        <input type="text" name="modele" value="{{ old('modele') }}" placeholder="ex: RAV4" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Année <span class="text-red-500">*</span></label>
                        <input type="number" name="annee" value="{{ old('annee', date('Y')) }}" min="1950" max="{{ date('Y') + 1 }}" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Carburant <span class="text-red-500">*</span></label>
                        <select name="carburant" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                            <option value="">-- Choisir --</option>
                            <option value="Essence" {{ old('carburant') == 'Essence' ? 'selected' : '' }}>Essence</option>
                            <option value="Diesel" {{ old('carburant') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="Hybride" {{ old('carburant') == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                            <option value="Électrique" {{ old('carburant') == 'Électrique' ? 'selected' : '' }}>Électrique</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Boîte de Vitesses <span class="text-red-500">*</span></label>
                        <select name="boite" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                            <option value="">-- Choisir --</option>
                            <option value="Manuelle" {{ old('boite') == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                            <option value="Automatique" {{ old('boite') == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kilométrage (km) <span class="text-red-500">*</span></label>
                        <input type="number" name="kilometrage" value="{{ old('kilometrage') }}" min="0" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-blue-900 mb-2">Prix de vente (FCFA) <span class="text-red-500">*</span></label>
                        <div class="relative flex items-center">
                            <input type="number" name="prix" value="{{ old('prix') }}" min="0" step="5000" required placeholder="ex: 8500000"
                                   class="w-full p-3 border-2 border-blue-200 rounded-lg text-xl font-bold text-blue-800 focus:border-blue-500 outline-none pr-16">
                            <span class="absolute right-3 font-black text-blue-400 text-sm">XOF</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description / Options</label>
                    <textarea name="description" rows="4" placeholder="Climatisation, Toit ouvrant, Jantes alu, etc." 
                              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-sans">{{ old('description') }}</textarea>
                </div>

                <div class="mb-10 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                    <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-widest">Photos du véhicule</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-blue-600 mb-1">IMAGE PRINCIPALE (Affiche en premier)</label>
                            <input type="file" name="image" accept="image/*" required 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-gray-500 mb-1">PHOTOS SUPPLÉMENTAIRES</label>
                            <input type="file" name="images[]" multiple accept="image/*" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 border-t border-gray-100 pt-8">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-black py-4 rounded-lg transition-all shadow-md active:transform active:scale-95 uppercase">
                        <i class="fas fa-plus-circle mr-2"></i> Publier le véhicule
                    </button>
                    <a href="{{ route('admin.cars.index') }}" class="sm:w-1/3 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-lg transition-all uppercase text-sm flex items-center justify-center">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </section>

    <style>
        /* Supprimer les flèches des inputs number pour un look plus propre */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
@endsection