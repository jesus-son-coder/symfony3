<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 26/04/2020
 * Time: 00:47
 **/

namespace AppBundle\Twig;


class MarkdownExtension extends \Twig_Extension
{
  public function getName()
  {
    return 'app_markdown';
  }

  public function getFilters()
  {
    return [
      new \Twig_SimpleFilter('markdownify', array($this, 'parseMardown'))
    ];
  }

  public function parseMarkdown($str)
  {
    return strtoupper($str);
  }
}