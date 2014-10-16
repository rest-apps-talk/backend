<?php
namespace Lcobucci\BlogMV\Articles\Controllers;

use Lcobucci\ActionMapper2\Routing\Annotation\Route;
use Lcobucci\ActionMapper2\Routing\Controller;
use Lcobucci\ActionMapper2\Errors\PageNotFoundException;
use Lcobucci\BlogMV\Articles\Article;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Comments extends Controller
{
    /**
     * @Route("/(id)", methods={"GET"})
     *
     * @param int $article
     * @param int $id
     */
    public function show($article, $id)
    {
        $this->response->setContentType('application/json');

        $comment = $this->get('comments.repository')->findOneBy(
            [
                'article' => $this->getArticle($article),
                'id' => $id
            ]
        );

        if ($comment === null) {
            throw new PageNotFoundException('Comment #' . $id . ' not found');
        }

        return json_encode($comment);
    }

    /**
     * @Route("/", methods={"GET"})
     *
     * @param int $article
     */
    public function listAll($article)
    {
        $this->response->setContentType('application/json');

        return json_encode(
            $this->get('comments.repository')->findBy(
                ['article' => $this->getArticle($article)]
            )
        );
    }

    /**
     * @Route("/", methods={"POST"})
     *
     * @param int $article
     */
    public function insert($article)
    {
        $fields = json_decode($this->request->getContent());

        $comment = $this->get('comments.creator')->create(
            $this->getArticle($article),
            $fields->author_email,
            $fields->author_name,
            $fields->content
        );

        $path = sprintf('/articles/%d/comments/%d', $article, $comment->getId());

        $this->response->setStatusCode(201);
        $this->response->setContentType('application/json');
        $this->response->headers->add(['Location' => $this->request->getUriForPath($path)]);

        return json_encode($comment);
    }

    /**
     * @param int $id
     *
     * @return Article
     */
    private function getArticle($id)
    {
        return $this->get('articles.repository')->find($id);
    }

    /**
     * @Route("/", methods={"OPTIONS"})
     */
    public function renderDocCollection()
    {
        $this->response->setContentType('application/json');
        $this->response->headers->set('Allow', 'GET,POST');

        return json_encode(
            [
                'GET' => 'Exibe a lista de comentáios do artigo.',
                'POST' => 'Cria um novo comentário'
            ]
        );
    }

    /**
     * @Route("/(id)", methods={"OPTIONS"})
     */
    public function renderDoc()
    {
        $this->response->setContentType('application/json');
        $this->response->headers->set('Allow', 'GET');

        return json_encode(['GET' => 'Exibe os dados de um coment�rio.']);
    }

}
