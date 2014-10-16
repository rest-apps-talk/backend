<?php
namespace Lcobucci\BlogMV\Articles\Services;

use Doctrine\ORM\EntityManagerInterface;
use Lcobucci\BlogMV\Articles\Article;
use Lcobucci\BlogMV\Articles\Comment;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CommentCreator
{
    /**
     * @var AuthorRetriever
     */
    private $authorRetriever;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        AuthorRetriever $authorRetriever,
        EntityManagerInterface $entityManager
    ) {
        $this->authorRetriever = $authorRetriever;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Article $article
     * @param string $authorEmail
     * @param string $authorName
     * @param string $content
     *
     * @return Comment
     */
    public function create(Article $article, $authorEmail, $authorName, $content)
    {
        $comment = new Comment(
            $article,
            $this->authorRetriever->retrieve($authorEmail, $authorName),
            $content
        );

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $comment;
    }
}
