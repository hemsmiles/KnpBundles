<?php

namespace Knp\Bundle\Symfony2BundlesBundle\Menu;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Knp\Bundle\MenuBundle\Menu;

class MainMenu extends Menu
{
    public function __construct(Request $request, UrlGeneratorInterface $router, Translator $translator)
    {
        parent::__construct(array(
            'id'    => 'menu'
        ));

        $this->setCurrentUri($request->getRequestUri());

        $this->addChild($translator->trans('menu.bundles'), $router->generate('bundle_list', array()));
        $this->addChild($translator->trans('menu.projects'), $router->generate('project_list', array()));
        $this->addChild($translator->trans('menu.users'), $router->generate('user_list', array()));
    }
}
