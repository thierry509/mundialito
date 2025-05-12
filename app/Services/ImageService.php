<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager; // Nouvelle approche en v3+
use Intervention\Image\Drivers\Gd\Driver; // Ou Imagick si préféré

class ImageService
{
    public function store($file, string $desc, $path = 'uploads', int $width = 300, int $height = 200)
    {
        $manager = new ImageManager(new Driver()); // GD par défaut

        // Création de l'image et de la miniature
        $image = $manager->read($file->getRealPath());

        // Redimensionnement + encodage
        $thumbnail = $image->resize($width, $height);

        // Chemins de stockage
        $filename = $this->manageName($desc); // Meilleur format que JPEG/PNG
        $originalPath = "{$path}/{$filename}";
        $thumbnailPath = "{$path}/thumbnails/{$filename}";

        // Sauvegarde
        $image->save(storage_path("app/public/{$originalPath}"));
        $thumbnail->save(storage_path("app/public/{$thumbnailPath}"));

        return [
            'original' => $originalPath,
            'thumbnail' => $thumbnailPath
        ];
    }

    protected function manageName(string $description): string
    {
        $slug = Str::slug($description);

        $extension = 'webp';
        $baseName = "{$slug}.{$extension}";

        // 3. Si le fichier existe déjà, ajouter un random_int
        if (Storage::exists("public/images/{$baseName}")) {
            $suffix = random_int(1000, 9999);
            $baseName = "{$slug}-{$suffix}.{$extension}";
        }

        return $baseName;
    }
}


