<?php

namespace App\DataFixtures;

use App\Entity\Collecte;
use App\Entity\Don;
use App\Entity\Donateur;
use App\Entity\Lieu;
use App\Entity\RendezVous;
use App\Entity\Stock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use PgSql\Lob;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $GroupeSanguinPossible = ['A+', 'A-',' B+',' B-', 'AB+', 'AB-', 'O+',' O-'];
        $GroupeSanguin =[];

        $typeDonListe = ['Sangtotal','plasma','plaquettes'];

        $collecteStatut =['lanifiée','Terminée'];

        $Statut_Renez_Vous = ['confirmém','Annulé','Effectué'];

        $faker = Factory::create('fr_FR');
        for($i=0; $i <20; $i++){
         $donateur = new Donateur();
         $don = new Don();
         $stock = new Stock();
         $collecte = new Collecte();
         $lieu = new Lieu();
         $rendezVous = new RendezVous();


         //**************      Don      ***************************** */
         //date
         $don->setDatedon($faker->dateTime);
         //quantity
         $don-> setQuantite($faker->numberBetween(1,100));
        
        //type Don
        $don->setTypeDon($faker -> randomElement($typeDonListe));
        
        //apte
        $don ->setApte($faker->boolean());

        //Commentaire
        $don->setCommentaire($faker->realText(100));



        //**************      Donateur       ***************************** */
         //email
         $composerEmail =  $faker->sentence();
         $composerEmail = substr($composerEmail,0,8);
         $composerEmail .='@gmail.com';
          $donateur->setEmail($composerEmail);
        //prenom
         $donateur->setPrenom($faker->lastName());

        //password
        $passwordCreation = $faker->sentence();
        $password = substr($passwordCreation,0,25);
        $donateur->setPassword($password);

        //groupe Sanguin 
        $donateur->setGroupeSanguin($faker->randomElement($GroupeSanguinPossible));
        
        //dernierDateDon
        $donateur->setDerniereDateDon($faker->dateTime);
        
        //role de donateur
        $donateur->setRole(substr($passwordCreation,0,25));

/*    **************************     Collect      ******************************** */

        //nom
        $collecte->setNom($faker->firstName());

        //Date Debut 
        $dateDebut = $faker->dateTimeBetween('now', '+1 month');
        //date fin
        $dateFin =$faker->dateTimeBetween($dateDebut,'+2 month');

        $collecte->setDateDebut($dateDebut);
        $collecte->setDateFin($dateFin);

        //Capacite Maximale
        $collecte->setCapaciteMaximale($faker->numberBetween(10,100));

        //statut
        $collecte->setStatut($faker ->randomElement($collecteStatut));



      /* *******************************      Lieu          *************************************************/  
        

        //nom lieu
        $lieu->setNomLieu($faker->country());
        //adresse 
        $lieu->setAdresse($faker->address());
        //ville
        $lieu->setVille($faker->city());
        //code Postal
        $lieu->setCodePostal($faker->postcode());
        
      /* *******************************     Rendez-Vous      *************************************************/  

      //Date Debut 
      $dateDebut_RV = $faker->dateTimeBetween('now', '+1 month');
      //date fin
      $dateFin_RV =$faker->dateTimeBetween($dateDebut_RV ,'+2 month');

      $rendezVous->setDateHeureDebut($dateDebut_RV);
      $rendezVous->setDateheureFin($dateFin_RV);


      $rendezVous->setStatut($faker->randomElement($Statut_Renez_Vous));
        $manager->persist($donateur);
        }
        
      /* *******************************    Stock     *************************************************/  

      $stock->setGroupeSanguin($faker->randomElement( $GroupeSanguinPossible));

     $stock->setNiveauActuel($faker->randomElement([
        'Faible',
        'Moyen',
        'Élevé'
    ]));
    $stock->setNiveauAlerte($faker->randomElement([
        'Normal',
        'Alerte',
        'Critique'
    ]));
    $stock->setDernierMiseAJour($faker->dateTimeThisYear());
      $stock;
        $manager->flush();
    }
}
