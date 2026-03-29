<?php
namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // Créer un ADMIN
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        // Créer un USER normal
        $user = new User();
        $user->setUsername('user1');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        // Événements de test
        $events = [
            ['Concert Jazz', 'Un concert de jazz incroyable', '2026-05-10 20:00', 'Tunis', 200, 'https://picsum.photos/seed/jazz/800/400'],
            ['Conférence Tech', 'Les dernières tendances en IA', '2026-06-15 09:00', 'Sousse', 100, 'https://picsum.photos/seed/tech/800/400'],
            ['Festival Été', 'Festival de musique en plein air', '2026-07-20 18:00', 'Hammamet', 500, 'https://picsum.photos/seed/fest/800/400'],
        ];

        foreach ($events as [$title, $desc, $date, $loc, $seats, $img]) {
            $event = new Event();
            $event->setTitle($title)
                  ->setDescription($desc)
                  ->setDate(new \DateTime($date))
                  ->setLocation($loc)
                  ->setSeats($seats)
                  ->setImage($img);
            $manager->persist($event);
        }

        $manager->flush();
    }
}