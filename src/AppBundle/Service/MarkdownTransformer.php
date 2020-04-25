<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 25/04/2020
 * Time: 23:09
 **/

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
  private $markdownParser;

  /**
   * MarkdownTransformer constructor.
   */
  public function __construct(MarkdownParserInterface $markdownParser)
  {
    $this->markdownParser = $markdownParser;
  }

  public function parse($str)
  {
    return $this->markdownParser
      ->transformMarkdown($str);
  }


  public function oldParser()
  {
    /*
     * Désactiver le Cache :
    $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
    $key = md5($funFact);
    if ($cache->contains($key)) {
      $funFact = $cache->fetch($key);
    } else {
      $funFact = $this->get('markdown.parser')
        ->transform($funFact);
      $cache->save($key, $funFact);
    }
    */
  }
}