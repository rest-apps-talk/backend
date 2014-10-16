<?php
namespace Lcobucci\BlogMV\Articles;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table("comment")
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class Comment implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     *
     * @var Article
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="Author", cascade={"all"})
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     *
     * @var Author
     */
    private $author;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @var string
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    private $date;

    /**
     * @param Article $article
     * @param Author $author
     * @param string $content
     */
    public function __construct(Article $article, Author $author, $content)
    {
        $this->article = $article;
        $this->author = $author;
        $this->content = $content;
        $this->date = new DateTime();
    }

	/**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

	/**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

	/**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

	/**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

	/**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'article' => $this->article->getId(),
            'author' => $this->author,
            'content' => $this->content,
            'date' => $this->date->format(DateTime::W3C)
        ];
    }
}
