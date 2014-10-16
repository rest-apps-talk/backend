<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Projectbe84610688c8b452a8f3bcb2572a4414ServiceContainer
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class Projectbe84610688c8b452a8f3bcb2572a4414ServiceContainer extends Lcobucci\ActionMapper2\DependencyInjection\Container
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(new ParameterBag($this->getDefaultParameters()));
        $this->methodMap = array(
            'articles.repository' => 'getArticles_RepositoryService',
            'authors.repository' => 'getAuthors_RepositoryService',
            'authors.retriever' => 'getAuthors_RetrieverService',
            'cache.apc' => 'getCache_ApcService',
            'cache.array' => 'getCache_ArrayService',
            'comments.creator' => 'getComments_CreatorService',
            'comments.repository' => 'getComments_RepositoryService',
            'orm.config' => 'getOrm_ConfigService',
            'orm.config.annotation.cachedreader' => 'getOrm_Config_Annotation_CachedreaderService',
            'orm.config.annotation.driver' => 'getOrm_Config_Annotation_DriverService',
            'orm.config.annotation.reader' => 'getOrm_Config_Annotation_ReaderService',
            'orm.connection' => 'getOrm_ConnectionService',
            'orm.em' => 'getOrm_EmService',
        );
    }

    /**
     * Gets the 'articles.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return object An instance returned by orm.em::getRepository().
     */
    protected function getArticles_RepositoryService()
    {
        return $this->services['articles.repository'] = $this->get('orm.em')->getRepository('Lcobucci\\BlogMV\\Articles\\Article');
    }

    /**
     * Gets the 'authors.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return object An instance returned by orm.em::getRepository().
     */
    protected function getAuthors_RepositoryService()
    {
        return $this->services['authors.repository'] = $this->get('orm.em')->getRepository('Lcobucci\\BlogMV\\Articles\\Author');
    }

    /**
     * Gets the 'authors.retriever' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Lcobucci\BlogMV\Articles\Services\AuthorRetriever A Lcobucci\BlogMV\Articles\Services\AuthorRetriever instance.
     */
    protected function getAuthors_RetrieverService()
    {
        return $this->services['authors.retriever'] = new \Lcobucci\BlogMV\Articles\Services\AuthorRetriever($this->get('authors.repository'), $this->get('orm.em'));
    }

    /**
     * Gets the 'cache.apc' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Cache\ApcCache A Doctrine\Common\Cache\ApcCache instance.
     */
    protected function getCache_ApcService()
    {
        $this->services['cache.apc'] = $instance = new \Doctrine\Common\Cache\ApcCache();

        $instance->setNamespace($this->getParameter('cache.namespace'));

        return $instance;
    }

    /**
     * Gets the 'cache.array' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Cache\ArrayCache A Doctrine\Common\Cache\ArrayCache instance.
     */
    protected function getCache_ArrayService()
    {
        $this->services['cache.array'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

        $instance->setNamespace($this->getParameter('cache.namespace'));

        return $instance;
    }

    /**
     * Gets the 'comments.creator' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Lcobucci\BlogMV\Articles\Services\CommentCreator A Lcobucci\BlogMV\Articles\Services\CommentCreator instance.
     */
    protected function getComments_CreatorService()
    {
        return $this->services['comments.creator'] = new \Lcobucci\BlogMV\Articles\Services\CommentCreator($this->get('authors.retriever'), $this->get('orm.em'));
    }

    /**
     * Gets the 'comments.repository' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return object An instance returned by orm.em::getRepository().
     */
    protected function getComments_RepositoryService()
    {
        return $this->services['comments.repository'] = $this->get('orm.em')->getRepository('Lcobucci\\BlogMV\\Articles\\Comment');
    }

    /**
     * Gets the 'orm.config' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\ORM\Configuration A Doctrine\ORM\Configuration instance.
     */
    protected function getOrm_ConfigService()
    {
        $a = $this->get('cache.apc');

        $this->services['orm.config'] = $instance = new \Doctrine\ORM\Configuration();

        $instance->setMetadataCacheImpl($a);
        $instance->setResultCacheImpl($a);
        $instance->setProxyDir(''.$this->getParameter('app.basedir').'tmp');
        $instance->setProxyNamespace($this->getParameter('orm.proxy.namespace'));
        $instance->setAutoGenerateProxyClasses($this->getParameter('app.devmode'));
        $instance->setMetadataDriverImpl($this->get('orm.config.annotation.driver'));

        return $instance;
    }

    /**
     * Gets the 'orm.config.annotation.cachedreader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Annotations\CachedReader A Doctrine\Common\Annotations\CachedReader instance.
     */
    protected function getOrm_Config_Annotation_CachedreaderService()
    {
        return $this->services['orm.config.annotation.cachedreader'] = new \Doctrine\Common\Annotations\CachedReader($this->get('orm.config.annotation.reader'), $this->get('cache.apc'));
    }

    /**
     * Gets the 'orm.config.annotation.driver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\ORM\Mapping\Driver\AnnotationDriver A Doctrine\ORM\Mapping\Driver\AnnotationDriver instance.
     */
    protected function getOrm_Config_Annotation_DriverService()
    {
        return $this->services['orm.config.annotation.driver'] = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($this->get('orm.config.annotation.cachedreader'), ($this->getParameter("app.basedir") . $this->getParameter("orm.entity.basedir")));
    }

    /**
     * Gets the 'orm.config.annotation.reader' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Doctrine\Common\Annotations\AnnotationReader A Doctrine\Common\Annotations\AnnotationReader instance.
     */
    protected function getOrm_Config_Annotation_ReaderService()
    {
        return $this->services['orm.config.annotation.reader'] = new \Doctrine\Common\Annotations\AnnotationReader();
    }

    /**
     * Gets the 'orm.connection' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return object An instance returned by orm.em::getConnection().
     */
    protected function getOrm_ConnectionService()
    {
        return $this->services['orm.connection'] = $this->get('orm.em')->getConnection();
    }

    /**
     * Gets the 'orm.em' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return object An instance returned by Doctrine\ORM\EntityManager::create().
     */
    protected function getOrm_EmService()
    {
        return $this->services['orm.em'] = \Doctrine\ORM\EntityManager::create(array('host' => $this->getParameter('db.host'), 'dbname' => $this->getParameter('db.schema'), 'user' => $this->getParameter('db.user'), 'password' => $this->getParameter('db.passwd'), 'driver' => $this->getParameter('db.driver'), 'charset' => $this->getParameter('db.charset')), $this->get('orm.config'));
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'app.basedir' => '/var/www/blogmv-api/',
            'app.devmode' => true,
            'cache.namespace' => 'blogmv',
            'db.host' => '127.0.0.1',
            'db.schema' => 'blogmv',
            'db.user' => 'root',
            'db.passwd' => 'admin',
            'db.driver' => 'pdo_mysql',
            'db.charset' => 'utf8',
            'orm.proxy.namespace' => 'Proxy',
            'orm.entity.basedir' => 'src',
        );
    }
}
