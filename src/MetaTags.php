<?php 

/**
 * This file is part of the MetaTags package.
 * 
 * (c) Marc Witteveen <marc.witteveen@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MarcWitteveen\MetaTags;

class MetaTags {

	private $meta;

	private $rules = [];

	private $aliases = [];

	public function __construct()
	{
		$this->meta = new \SimpleXMLIterator('<meta/>');
        $this->init();
	}

	protected function init() 
	{
		$this
			// Generic
			->addRule('title', [$this, 'ruleTitle'])
            ->addRule('description', [$this, 'ruleCommon'])
            ->addRule('keywords', [$this, 'ruleCommon'])
            ->addRule('robots', [$this, 'ruleName'])
            ->addRule('dns-prefetch', [$this, 'ruleLink'])
            ->addRule('preconnect', [$this, 'ruleLink'])
            ->addRule('prefetch', [$this, 'ruleLink'])
            ->addRule('subresource', [$this, 'ruleLink'])
            ->addRule('prerender', [$this, 'ruleLink'])
            ->addRule('preload', [$this, 'ruleLink'])
            ->addRule('canonical', [$this, 'ruleLink'])
            ->addRule('prev', [$this, 'ruleLink'])
            ->addRule('next', [$this, 'ruleLink'])
            ->addRule('alternate', [$this, 'ruleLink'])
            ->addRule('rss', [$this, 'ruleRSS'])
            ->addRule('viewport', [$this, 'ruleViewPort'])
            ->addRule('content-language', [$this, 'ruleHTTPEquiv'])
            ->addAlias('language', 'content-language')
            ->addRule('content-type', [$this, 'ruleHTTPEquiv'])
            ->addRule('charset', [$this, 'ruleCharset'])
            ->addRule('keywords', [$this, 'ruleCommon'])
            ->addRule('geo.position', [$this, 'ruleCommon'])
            ->addRule('geo.placename', [$this, 'ruleCommon'])
            ->addRule('geo.region', [$this, 'ruleCommon'])
            // Facebook
            ->addRule('fb:app_id', [$this, 'ruleCommon'])
            ->addRule('og:title', [$this, 'ruleCommon'])
            ->addRule('og:description', [$this, 'ruleCommon'])
            ->addRule('og:type', [$this, 'ruleCommon'])
            ->addRule('og:url', [$this, 'ruleCommon'])
            ->addRule('og:determiner', [$this, 'ruleCommon'])
            ->addRule('og:locale', [$this, 'ruleCommon'])
            ->addRule('og:locale:alternate', [$this, 'ruleCommon'])
            ->addRule('og:site_name', [$this, 'ruleCommon'])
            ->addRule('og:image', [$this, 'ruleCommon'])
            ->addRule('og:image:secure_url', [$this, 'ruleCommon'])
            ->addRule('og:image:type', [$this, 'ruleCommon'])
            ->addRule('og:image:width', [$this, 'ruleCommon'])
            ->addRule('og:image:height', [$this, 'ruleCommon'])
            ->addRule('og:audio', [$this, 'ruleCommon'])
            ->addRule('og:audio:secure_url', [$this, 'ruleCommon'])
            ->addRule('og:audio:type', [$this, 'ruleCommon'])
            ->addRule('og:video', [$this, 'ruleCommon'])
            ->addRule('og:video:secure_url', [$this, 'ruleCommon'])
            ->addRule('og:video:type', [$this, 'ruleCommon'])
            ->addRule('og:video:width', [$this, 'ruleCommon'])
            ->addRule('og:video:height', [$this, 'ruleCommon'])
            ->addRule('article:published_time', [$this, 'ruleCommon'])
            ->addRule('article:modified_time', [$this, 'ruleCommon'])
            ->addRule('article:expiration_time', [$this, 'ruleCommon'])
            ->addRule('article:author', [$this, 'ruleCommon'])
            ->addRule('article:section', [$this, 'ruleCommon'])
            ->addRule('article:tag', [$this, 'ruleCommon'])
            ->addRule('book:author', [$this, 'ruleCommon'])
            ->addRule('book:isbn', [$this, 'ruleCommon'])
            ->addRule('book:release_date', [$this, 'ruleCommon'])
            ->addRule('book:tag', [$this, 'ruleCommon'])
            ->addRule('profile:first_name', [$this, 'ruleCommon'])
            ->addRule('profile:last_name', [$this, 'ruleCommon'])
            ->addRule('profile:username', [$this, 'ruleCommon'])
            ->addRule('profile:gender', [$this, 'ruleCommon'])
            ->addRule('music:duration', [$this, 'ruleCommon'])
            ->addRule('music:album', [$this, 'ruleCommon'])
            ->addRule('music:album:disc', [$this, 'ruleCommon'])
            ->addRule('music:album:track', [$this, 'ruleCommon'])
            ->addRule('music:musician', [$this, 'ruleCommon'])
            ->addRule('music:song', [$this, 'ruleCommon'])
            ->addRule('music:song:disc', [$this, 'ruleCommon'])
            ->addRule('music:song:track', [$this, 'ruleCommon'])
            ->addRule('music:release_date', [$this, 'ruleCommon'])
            ->addRule('music:creator', [$this, 'ruleCommon'])
            ->addRule('video:actor', [$this, 'ruleCommon'])
            ->addRule('video:actor:role', [$this, 'ruleCommon'])
            ->addRule('video:director', [$this, 'ruleCommon'])
            ->addRule('video:writer', [$this, 'ruleCommon'])
            ->addRule('video:duration', [$this, 'ruleCommon'])
            ->addRule('video:release_date', [$this, 'ruleCommon'])
            ->addRule('video:tag', [$this, 'ruleCommon'])
            ->addRule('video:series', [$this, 'ruleCommon'])
            // Twitter
            ->addRule('twitter:title', [$this, 'ruleCommon'])
            ->addRule('twitter:description', [$this, 'ruleCommon'])
            ->addRule('twitter:card', [$this, 'ruleCommon'])
            ->addRule('twitter:site', [$this, 'ruleCommon'])
            ->addRule('twitter:site:id', [$this, 'ruleCommon'])
            ->addRule('twitter:creator', [$this, 'ruleCommon'])
            ->addRule('twitter:creator:id', [$this, 'ruleCommon'])
            ->addRule('twitter:image', [$this, 'ruleCommon'])
            ->addRule('twitter:image:alt', [$this, 'ruleCommon'])
            ->addRule('twitter:player', [$this, 'ruleCommon'])
            ->addRule('twitter:player:width', [$this, 'ruleCommon'])
            ->addRule('twitter:player:height', [$this, 'ruleCommon'])
            ->addRule('twitter:player:stream', [$this, 'ruleCommon'])
            ->addRule('twitter:app:name:iphone', [$this, 'ruleCommon'])
            ->addRule('twitter:app:id:iphone', [$this, 'ruleCommon'])
            ->addRule('twitter:app:url:iphone', [$this, 'ruleCommon'])
            ->addRule('twitter:app:name:ipad', [$this, 'ruleCommon'])
            ->addRule('twitter:app:id:ipad', [$this, 'ruleCommon'])
            ->addRule('twitter:app:url:ipad', [$this, 'ruleCommon'])
            ->addRule('twitter:app:name:googleplay', [$this, 'ruleCommon'])
            ->addRule('twitter:app:id:googleplay', [$this, 'ruleCommon'])
            ->addRule('twitter:app:url:googleplay', [$this, 'ruleCommon']);
	}

    protected function ruleViewPort($viewport) 
    {
        $meta = $this->getMeta()->addChild('meta');
        $meta->addAttribute('name', 'viewport');
        $meta->addAttribute('content', $viewport);
    }

    protected function ruleRSS($href, $rel)
    {
        $this->ruleLink($href, $rel, 'application/rss+xml');
    }

	protected function ruleLink($href, $rel, $type = null)
    {
        $meta = $this->getMeta()->addChild('link');

        $meta->addAttribute('rel', $rel);
        $meta->addAttribute('href', $href);

        if ($type !== null) {
            $meta->addAttribute('type', $type);
        }
    }

	protected function ruleHTTPEquiv($content, $http_equiv)
    {
        $meta = $this->getMeta()->addChild('meta');
        $meta->addAttribute('http-equiv', $http_equiv);
        $meta->addAttribute('content', $content);
    }

	protected function ruleCharset($charset)
    {
        $meta = $this->getMeta()->addChild('meta');
        $meta->addAttribute('charset', $charset);
    }

	protected function ruleTitle($value)
    {
        $this->getMeta()->addChild('title', $value);
    }

	protected function ruleCommon($content, $name)
    {
        $meta = $this->getMeta()->addChild('meta');
        $meta->addAttribute('property', $name);
        $meta->addAttribute('content', $content);
    }

    protected function ruleName($content, $name) 
    {
        $meta = $this->getMeta()->addChild('meta');
        $meta->addAttribute('name', 'name');
        $meta->addAttribute('content', $viewport);
    }

	protected function getMeta()
    {
        return $this->meta;
    }

	protected function addAlias($alias, $name)
    {
        $this->aliases[$alias] = $name;
		return $this;
    }

	protected function addRule($name, callable $callable)
    {
        $this->rules[$name] = $callable;
		return $this;
    }

	public function add($name, $value)
    {
        if (array_key_exists($name, $this->aliases)) {
            $name = $this->aliases[$name];
        }

        if (array_key_exists($name, $this->rules)) {
            call_user_func($this->rules[$name], $value, $name);
        }

        return $this;
    }

	public function build($output = true)
    {
        $build = '';

        for($this->meta->rewind(); $this->meta->valid(); $this->meta->next() ) {
            $build .= $this->meta->current()->asXML() . "\n";
        }
        if ($output == true) {
        	echo $build;
        } else {
        	return $build;
        }
    }
}