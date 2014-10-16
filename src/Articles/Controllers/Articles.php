<?php
namespace Lcobucci\BlogMV\Articles\Controllers;

use Lcobucci\ActionMapper2\Routing\Annotation\Route;
use Lcobucci\ActionMapper2\Routing\Controller;
use Lcobucci\ActionMapper2\Errors\PageNotFoundException;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Articles extends Controller
{
    /**
     * @Route("/(id)", methods={"GET"})
     *
     * @param int $id
     */
    public function show($id)
    {
        if ($article = $this->get('articles.repository')->find($id)) {
            $this->response->setContentType('application/json');

            return json_encode($article);
        }

        throw new PageNotFoundException('Article #' . $id . ' not found');
    }

    /**
     * @Route("/", methods={"GET"})
     *
     * @param int $id
     */
    public function listAll()
    {
        $this->response->setContentType('application/json');

        return json_encode($this->get('articles.repository')->findAll());
    }

    /**
     * @Route("/", methods={"OPTIONS"})
     */
    public function renderDocCollection()
    {
        $this->response->setContentType('application/json');
        $this->response->headers->set('Allow', 'GET');

        return json_encode(['GET' => 'Exibe a lista de artigos.']);
    }

    /**
     * @Route("/(id)", methods={"OPTIONS"})
     */
    public function renderDoc()
    {
        $this->response->setContentType('application/json');
        $this->response->headers->set('Allow', 'GET');

        return json_encode(['GET' => 'Exibe os dados de um artigo.']);
    }
}
