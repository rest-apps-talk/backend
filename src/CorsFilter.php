<?php
namespace Lcobucci\BlogMV;

use Lcobucci\ActionMapper2\Routing\Filter;

/**
 * @author Luí­s Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class CorsFilter extends Filter
{
    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $this->response->headers->set('Access-Control-Allow-Origin', '*');
        $this->response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
        $this->response->headers->set('Access-Control-Expose-Headers', 'Content-Type, Location, Allow');
    }
}
