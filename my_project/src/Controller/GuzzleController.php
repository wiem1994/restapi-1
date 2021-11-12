<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use GuzzleHttp\Client;


class GuzzleController extends AbstractController

{

    /**

     * @Route("/articles", name="get_posts")

     */

    public function getPosts(): Response

    {

        //require_once "vendor/autoload.php";

        $client = new Client([

            // Base URI is used with relative requests

            'base_uri' => 'http://127.0.0.1:8000',

        ]);



        $response = $client->request('GET', '/articles-new');


        //get status code using $response->getStatusCode();



        $body = $response->getBody();

        $arrBody = json_decode($body);

        return $this->render('Posts/posts.html.twig', [

            'posts' => $arrBody,

        ]);
    }

    /**

     * @Route("/post-articles", name="post_posts")

     */

    public function postPost(): Response

    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://127.0.0.1:8000',
        ]);

        $response = $client->request('POST', '/articles', [
            'json' => [
                'titre' => 'test',
                'contenu' => 'this is the body of test',
                'auteur' => '1',
                'datepublication' => '1',
            ]
        ]);

        //get status code using $response->getStatusCode();

        $body = $response->getBody();
        $arrBody = json_decode($body);
        return $this->render('Posts/show.html.twig', [

            'post' => $arrBody,

        ]);
    }

/**

     * @Route("/modify_post", name="modify_post")

     */

    public function modifyPost(): Response

    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
        ]);

        $response = $client->request('PUT', '/posts/1', [
            'json' => [
                'title' => 'test updated',
                'body' => 'this is the body of test updated'
            ]
        ]);

        //get status code using $response->getStatusCode();

        $body = $response->getBody();
        $arrBody = json_decode($body);
        return $this->render('Posts/show.html.twig', [

            'post' => $arrBody,

        ]);
    }


    /**

     * @Route("/delete_post", name="delete_post")

     */

    public function deletePost()

    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
        ]);

        $response = $client->request('DELETE', '/posts/1');
        echo $response->getStatusCode() . "</br>";

        return new Response("<html>user is deleted</html>");
    }

    /**

     * @Route("/comments", name="read_comments")

     */

    public function getComments(): Response

    {

        //require_once "vendor/autoload.php";

        $client = new Client([

            // Base URI is used with relative requests

            'base_uri' => 'https://jsonplaceholder.typicode.com/',

        ]);



        $response = $client->request('GET', '/comments?postId=1');


        $body = $response->getBody();

        $arrBody = json_decode($body);

        return $this->render('Posts/comments.html.twig', [

            'comments' => $arrBody,

        ]);
    }
}
