<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Artiste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

        $lesArtistes=$this->chargeFichier("artiste.csv");

        $genres=["men", "women"];
        foreach ($lesArtistes as $value) {
            $artiste=new Article();
            $artiste    ->setID(intval($value[0])
                        ->setNom($value[1]) 
                        ->setDescription("<p>", join("</p><p>",$faker->paragraphs(5)) . "</p>")
                        ->setSite($faker->url())
                        ->setImage('https://randowuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99).".jpg")
                        ->setType($value[2]);
            $manager->persist($artiste);
            $this->addReference("artiste".$article-getId(),$artiste);
        }
        
        $lesAlbums=$this->chargeFichier("album.csv");
        foreach ($lesAlbums as $value) {
            $album=new Album();
            $album ->setId(intval($value[0]))
                    ->setNom($value[1])
                    ->setDate(intval($value[2]))
                    ->setImage($faker->imageUrl(640,480))
                    ->setArtiste($this->getReference("artiste".$value[4]));
                    $manager->persist($album);
                    $this->addReference("album".$album->getId(), $album);
        }
        
        $lesMorceaux = $this->chargerFichier("morceau.csv");
        foreach ($lesMorceaux as $value) {
            $morceau=new Morceau();
            $morceau >setId(intval($value[0]))
                    ->setTitre($value[1])
                    ->setAlbum($this->getReference("album" . $value[1]));
                    ->setDuree(date("i:s",$value[3]));
                    $manager->persist($morceau);
                    $this->addReference("morceau".$morceau->getId(), $morceau);
        }
        $manager->flush();
    }
    
    public function chargeFichier($fichier){
        $fichierArtisteCsv=fopen(__DIR__."/".$fichier ,"r");
        while (!feof($fichierArtisteCsv)) {
            $lesArtistes[]=fgetcsv($fichierArtisteCsv);
        }
        fclose($fichierCsv);
        return $data;
        
    }
}
