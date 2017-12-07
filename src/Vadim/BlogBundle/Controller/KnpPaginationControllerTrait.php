<?php

namespace Vadim\BlogBundle\Controller;

use Knp\Component\Pager\Pagination\AbstractPagination;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

trait KnpPaginationControllerTrait
{
    /**
     * @param Request $request
     * @param mixed $target
     * @param int $maxResults
     * @param array $options
     * @return AbstractPagination
     */
    protected function knpPaginate(Request $request, $target, int $maxResults, array $options = []): AbstractPagination
    {
        /** @var Controller $this */
        if (!isset($options['pageParameterName'])) {
            $options['pageParameterName'] = 'page';
        }

        /** @var PaginatorInterface $paginator */
        $paginator = $this->get('knp_paginator');
        $page = max(1, (int) $request->query->get($options['pageParameterName'], 1));

        /** @var AbstractPagination $pagination */
        $pagination = $paginator->paginate($target, $page, $maxResults, $options);

        return $pagination;
    }
}
