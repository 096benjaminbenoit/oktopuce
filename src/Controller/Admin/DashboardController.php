<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\equipment;
use App\Entity\GasTypes;
use App\Entity\Intervention;
use App\Entity\Location;
use App\Entity\Model;
use App\Entity\NfcTag;
use App\Entity\Person;
use App\Entity\Site;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Oktopuce');
            // ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les marques', 'fas fa-tag', Brand::class);
        yield MenuItem::linkToCrud('Les clients', 'fas fa-users', Client::class);
        yield MenuItem::linkToCrud('Les contacts', 'fas fa-phone', Contact::class);
        yield MenuItem::linkToCrud('Les équipements', 'fas fa-box', equipment::class);
        yield MenuItem::linkToCrud('Les gaz', 'fas fa-fire-flame-simple', GasTypes::class);
        yield MenuItem::linkToCrud('Les interventions', 'fas fa-clipboard', Intervention::class);
        yield MenuItem::linkToCrud('Les emplacements', 'fas fa-location-dot', Location::class);
        yield MenuItem::linkToCrud('Les modèles', 'fas fa-tags', Model::class);
        yield MenuItem::linkToCrud('Les puces NFC', 'fa-brands fa-nfc-symbol', NfcTag::class);
        yield MenuItem::linkToCrud('Les personnes', 'fas fa-user', Person::class);
        yield MenuItem::linkToCrud('Les sites', 'fas fa-building', Site::class);
        yield MenuItem::linkToCrud('Les techniciens', 'fas fa-helmet-safety', User::class);

    }
}
