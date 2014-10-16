<?php
namespace Lcobucci\BlogMV\Articles\Services;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Lcobucci\BlogMV\Articles\Author;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class AuthorRetriever
{
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityRepository $repository,
        EntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $email
     * @param string $name
     *
     * @return Author
     */
    public function retrieve($email, $name)
    {
        $author = $this->getAuthor($email);
        $author->setName($name);

        $this->entityManager->persist($author);
        $this->entityManager->flush();

        return $author;
    }

    /**
     * @param string $email
     *
     * @return Author
     */
    private function getAuthor($email)
    {
        if ($author = $this->repository->findOneBy(['email' => $email])) {
            return $author;
        }

        return new Author($email);
    }
}
