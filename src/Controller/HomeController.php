<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonRespon;
use App\Entity\ScreenShot;
use App\Form\ScreenType;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/ScreanShot', name: 'app_screen')]
    public function get_Screen_shot(Request $request): Response
    {
        $screen_shot = new ScreenShot();
        $form = $this->createForm(ScreenType::class, $screen_shot);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if (filter_var($form['url']->getData(), FILTER_VALIDATE_URL) !== false)
                { 
                    // Run the Puppeteer script
                    $screenshotBase64 = $this->takeScreenshot($form['url']->getData(), $form['size']->getData());
                    $img_bass64 = 'image/png;base64,'.$screenshotBase64;
                    
                    return $this->render('index.html.twig', [
                        'form' => $form->createView(),
                        'img_bass64' => $screenshotBase64,
                    ]);
                }
            } catch(Exception $e){
                echo $e;
            }
        } else {
            return $this->render('index.html.twig', [
                'form' => $form->createView(),
            ]);
        }        
    }

    /**
     * this action used for calling on twig,
     * it has a Vue template inside it.
     *  */ 
    #[Route('/tackScreen', name: 'app_scre')]
    public function tack_screen(): Response
    {
        return $this->render('screen.html.twig');
    }

    /**
     * this action used for check request url and size,
     * adn excute script nde js for scrapping site web.
     *  */ 
    #[Route('/Scraping', name: 'app_scre')]
    public function takeScreenshot(Request $request): Response
    {   
        $data = json_decode($request->getContent(), true);
        $url = $data['url'];
        $size = $data['size'];

        // Check if the URL contains 'http://' or 'https://'
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            // If not, add 'https://'
            $url = 'https://' . $url;
        }

        //Check the correctness of url
        if (filter_var($url, FILTER_VALIDATE_URL) !== false && $size <= 1080 && $size >= 600)
        {
            try {
                // Run the Puppeteer script in a shell command
                // this is script node js 
                $screenshotBase64 = shell_exec("node ../scriptsNode/takeScreenShot.js $url $size");
                return $this->json(['success' => true,'image_bass64' => 'data:image/jpg;base64,'.$screenshotBase64, 'message' => 'Screenshot captured and fetched']);
            } catch(Exception $e) {
                return $this->json(['message' => $e]);
            }
        } else {
            return Route::redirect('/tackScreen');
        }
    }
}
