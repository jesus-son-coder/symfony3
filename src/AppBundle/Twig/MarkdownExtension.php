<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 26/04/2020
 * Time: 00:47
 **/

namespace AppBundle\Twig;


use AppBundle\Service\MarkdownTransformer;

class MarkdownExtension extends \Twig_Extension
{
  /**
   * @var MarkdownTransformer
   */
  private $markdownTransformer;

  /**
   * MarkdownExtension constructor.
   */
  public function __construct(MarkdownTransformer $markdownTransformer)
  {
    $this->markdownTransformer = $markdownTransformer;
  }

  public function getName()
  {
    return 'app_markdown';
  }

  public function getFilters()
  {
    return [
      new \Twig_SimpleFilter('markdownify', array($this, 'parseMarkdown'), [
        'is_safe' => ['html']
      ])
      // 'is_safe' => ['html'] : permet de remplacer le filtre "raw" dans le template Twig
    ];
  }

  public function parseMarkdown($str)
  {
    return $this->markdownTransformer->parse($str);
  }
}