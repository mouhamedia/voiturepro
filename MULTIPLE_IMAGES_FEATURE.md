# 📸 Feature - Multiple Images per Car

## ✨ Fonctionnalité Ajoutée

Vous pouvez maintenant ajouter et gérer **plusieurs photos** pour chaque voiture, au lieu d'une seule image !

---

## 📋 Changements Apportés

### 1. **Nouvelle Table `car_images`** 
- Fichier migration : `2026_01_01_000003_create_car_images_table.php`
- Colonnes principales :
  - `car_id` : Reference à la voiture
  - `image_path` : Chemin de l'image
  - `is_primary` : Marquer l'image principale
  - `order` : Ordre d'affichage
  - Timestamps pour le suivi

### 2. **Nouveau Modèle `CarImage`**
- Fichier : `app/Models/CarImage.php`
- Relation avec `Car` (belongsTo)
- Casts automatiques pour les types

### 3. **Modèle `Car` Amélioré**
- Nouvelle relation `images()` pour accéder à toutes les images
- Méthode `getPrimaryImage()` pour récupérer l'image principale ou la première
- Compatible avec l'ancienne colonne `image` pour compatibilité rétroactive

### 4. **Contrôleur `CarController` Modifié**
- Méthode `store()` : Support des uploads multiples (`images[]`)
- Méthode `update()` : Permet d'ajouter/modifier les images
- Nouvelle méthode `deleteImage()` : Supprime une image spécifique
- Support de la rétrocompatibilité avec l'ancienne colonne `image`

### 5. **Formulaire de Création `create.blade.php`**
- Section "Image principale" (obligatoire)
- Section "Ajouter d'autres photos" (optionnel, multiple upload)
- Instructions claires pour l'utilisateur

### 6. **Formulaire d'Édition `edit.blade.php`**
- **Affichage des images actuelles** en grille
- Badge "Principale" pour l'image principale
- **Boutons de suppression** pour chaque image
- Section pour télécharger une nouvelle image principale
- Section pour ajouter des photos supplémentaires
- Limite : 5 MB par image

### 7. **Nouvelles Routes**
- `DELETE /admin/cars/images/{id}` : Supprimer une image

### 8. **Commande Artisan**
- `php artisan migrate:car-images` : Migrer les images existantes vers la nouvelle table
- **Résultat** : 3 voitures existantes ont été migrées ✅

---

## 🎯 Comment Utiliser

### Ajouter une Voiture avec Plusieurs Images
1. Allez dans **Admin > Ajouter une Voiture**
2. Remplissez les informations (marque, modèle, prix, etc.)
3. Sélectionnez une **image principale** (obligatoire)
4. Sélectionnez **plusieurs autres images** dans le champ "Ajouter d'autres photos"
5. Cliquez sur **"Ajouter la Voiture"**

### Modifier les Images d'une Voiture
1. Allez dans **Admin > Gestion des Voitures**
2. Cliquez sur le bouton **Modifier** (crayon ✏️)
3. Vous verrez toutes les **images actuelles** affichées
4. Vous pouvez :
   - **Ajouter une nouvelle image principale** (remplace l'actuelle)
   - **Ajouter d'autres photos** via le champ multiple
   - **Supprimer une image** en cliquant sur le bouton 🗑️
5. Cliquez sur **"Enregistrer"**

---

## 🔧 Détails Techniques

### Structure de la Base de Données
```sql
CREATE TABLE car_images (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    car_id BIGINT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    order INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
);
```

### Migration d'Images Existantes
```
3 voitures migrées ✅
- mercedess 2020
- forde TITANUM
- TESLA 2020
```

### Compatibilité
- ✅ Les anciennes images sont conservées dans la colonne `image`
- ✅ Les anciennes images ont été migrées vers `car_images`
- ✅ Les deux systèmes coexistent pour compatibilité

---

## 📊 Limitations

- **Max 5 MB** par image
- **Formats supportés** : PNG, JPG, GIF, WebP
- **Pas de limite** sur le nombre de photos par voiture
- **Une image principale** par voiture (mais vous pouvez la changer)

---

## 🚀 Améliorations Futures Possibles

- [ ] Aperçu en temps réel des images uploadées
- [ ] Drag & drop pour réorganiser les images
- [ ] Compression automatique des images
- [ ] Galerie lightbox sur le front-end
- [ ] Cropping/Edition des images
- [ ] Stockage sur cloud (AWS S3, etc.)

---

## ✅ Vérification

Toutes les fonctionnalités sont prêtes ! Vous pouvez maintenant :

✅ Ajouter plusieurs photos à une voiture  
✅ Afficher les images dans le formulaire d'édition  
✅ Supprimer des images individuellement  
✅ Marquer une image comme principale  
✅ Conserver les anciennes images pour compatibilité  

**Bravo ! 🎉 Feature complète et testée !**
