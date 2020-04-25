<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 25/04/2020
 * Time: 23:09
 **/

namespace AppBundle\Service;


use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
  private $markdownParser;
  private $cache;

  /**
   * MarkdownTransformer constructor.
   * @param MarkdownParserInterface $markdownParser
   * @param Cache $cache
   */
  public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
  {
    $this->markdownParser = $markdownParser;
    $this->cache = $cache;
  }

  public function parse($str)
  {
    $cache = $this->cache;
    $key = md5($str);
    if ($cache->contains($key)) {
      $funFact = $cache->fetch($key);
    }

    sleep(1);
    $str = $this->markdownParser
      ->transformMarkdown($str);
    $cache->save($key, $str);

    return $str;
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