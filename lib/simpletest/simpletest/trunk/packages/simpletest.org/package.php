<?php

class SimpleTestXMLElement extends SimpleXMLElement {
    function title() {
        $titles = $this->xpath('//page');
        return $titles[0]->attributes()->title;
    }
    
    function transform_code($code) {
        $code = str_replace('<![CDATA[', '', $code);
        $code = str_replace(']]>', '', $code);
        $code = str_replace('<', '&lt;', $code);
        $code = str_replace('>', '&gt;', $code);
        $code = str_replace('&lt;strong&gt;', '<strong>', $code);
        $code = str_replace('&lt;/strong&gt;', '</strong>', $code);

        return $code;
    }

    function content() {
        $content = $this->introduction();
        $sections = $this->xpath('//section');
        if (count($sections) > 0) {
            $content .= $this->content_with_sections();
        } else {
            $content .= $this->content_without_sections();
        }
        $content = preg_replace("/href=\"([a-z_]*)\.php\"/", "href=\"\\1.html\"", $content);
        
        return $content;
    }
    
    function introduction() {
        $content = "";

        $introductions = $this->xpath('//introduction');
        foreach ($introductions as $introduction) {
            foreach ($introduction as $element) {
                $content .= $this->deal_with_php_code($element->asXML());
            }
        }
        
        return $content;
    }
    
    function content_without_sections() {
        $content_without_sections = "";
        $contents = $this->xpath('//content');
        foreach ($contents as $content) {
            $content_without_sections .= $this->deal_with_php_code($content->asXML());
        }
        
        return $content_without_sections;
    }
    
    function deal_with_php_code($content) {
        $elements_divided = preg_split('/<php>|<\/php>/', $content);
        $content_element = '';

        if (count($elements_divided) > 1) {
            foreach ($elements_divided as $element_divided) {
                if (strpos($element_divided, '<![CDATA[') === 0) {
                    $element_divided = '<pre>'.$this->transform_code($element_divided).'</pre>';
                }
                $content_element .= $element_divided;
            }
        } else {
            $content_element .= $content;
        }
        
        return $content_element;
    }

    function content_with_sections() {
        $content = "";
        $sections = $this->xpath('//section');
        foreach ($sections as $section) {
            $content .= "<a name=\"".(string)$section->attributes()->name."\">";
            $content .= "<h2>".(string)$section->attributes()->title."</h2>";
            foreach ($section as $element) {
                $content .= $this->deal_with_php_code($element->asXML());
            }
        }
        
        return $content;
    }

    function internal() {
        $internal = "";
        
        if (isset($this->internal->link)) {
            foreach ($this->internal->link as $link) {
                $internal .= "<div>".$link->asXML()."</div>";
            }
        }

        return $internal;
    }
    
    function external() {
        $external = "";

        if (isset($this->external->link)) {
            foreach ($this->external->link as $link) {
                $external .= "<div>".$link->asXML()."</div>";
            }
        }

        return $external;
    }

    function keywords() {
        return trim(preg_replace('/(\s+)/', ' ', $source->meta->keywords));
    }

    function here() {
        $pages = $this->xpath('//page');
        return $pages[0]->attributes()->here;
    }

    function parent($map) {
        $here = $this->here();
        $pages = $map->xpath('//page[normalize-space(@here)="'.$here.'"]/parent::*');
        return $pages[0]->attributes()->here;
    }

    function destination($path_to_map) {
        $destination = '';
        $here = $this->here();

        $map = simplexml_load_file($path_to_map);
        $pages = $map->xpath('//page');
        $i = 0;
        foreach ($pages as $page) {
            $i++;
            if ((string)$page->attributes()->here == $here) {
                $destination = (string)$page->attributes()->file;
                break;
            }
        }
        
        return $destination;
    }

    function url($file) {
        $segments = explode("/", $file);
        
        return array_pop($segments);
    }

    function links_from_xpath($xpath, $map) {
        $link = "";

        $here = $this->here();
        $pages = $map->xpath($xpath);
        foreach ($pages as $page) {
            $link .= '<li><a href="'.$this->url($page->attributes()->file).'">';
            $link .= $page->attributes()->title.'</a></li>';
        }
        
        return $link;
    }
    
    function links_parent_siblings_after($map) {
        $here = $this->parent($map);
        $query = '//page[normalize-space(@here)="'.$here.'"]/following-sibling::*';

        return $this->links_from_xpath($query, $map);
    }
    
    function links_parent($map) {
        $here = $this->parent($map);
        $query = '//page[normalize-space(@here)="'.$here.'"]';

        return $this->links_from_xpath($query, $map);
    }

    function links_parent_siblings_before($map) {
        $here = $this->parent($map);
        $query = '//page[normalize-space(@here)="'.$here.'"]/preceding-sibling::*';

        return $this->links_from_xpath($query, $map);
    }
    
    function links_parent_ancestors($map) {
        $here = $this->parent($map);
        return $this->links_ancestors_from($here, $map);
    }

    function links_self_ancestors($map) {
        $here = $this->here();
        return $this->links_ancestors_from($here, $map);
    }
    
    function links_ancestors_from($here, $map) {
        $link = "";

        $pages = $map->xpath('//page[normalize-space(@here)="'.$here.'"]/ancestor::*');
        foreach ($pages as $page) {
            $here = (string)$page->attributes()->here;
            if ($this->level_from_root($here, $map) >= 2) {
                $link .= '<li><a href="'.$this->url($page->attributes()->file).'">';
                $link .= $page->attributes()->title.'</a></li>';
            }
        }
        
        return $link;
    }
    function links_siblings_before($map) {
        $here = $this->here();
        $query = '//page[normalize-space(@here)="'.$here.'"]/preceding-sibling::*';

        return $this->links_from_xpath($query, $map);
    }

    function links_self($map) {
        $here = $this->here();
        $query = '//page[normalize-space(@here)="'.$here.'"]';

        return $this->links_from_xpath($query, $map);
    }

    function links_siblings_after($map) {
        $here = $this->here();
        $query = '//page[normalize-space(@here)="'.$here.'"]/following-sibling::*';

        return $this->links_from_xpath($query, $map);
    }

    function links_children($map) {
        $here = $this->here();
        $query = '//page[normalize-space(@here)="'.$here.'"]/child::*';

        return $this->links_from_xpath($query, $map);
    }

    function links($path_to_map) {
        $links['download'] = "";
        $links['start_testing'] = "";
        $links['support'] = "";
        $links['contribute'] = "";

        $map = simplexml_load_file($path_to_map);

        $link = '<ul>';
        $here = $this->here();
        $level = $this->level_from_root($here, $map);
        if ($level == 2) {
            $link .= $this->links_self($map);
            $link .= $this->links_children($map);
        }
        if ($level == 3) {
            $link .= $this->links_self_ancestors($map);        
            $link .= $this->links_siblings_before($map);
            $link .= $this->links_self($map);
            $chilren = $this->links_children($map);
            if ($chilren) {
                $link = preg_replace('/(<\/li>)$/', '', $link).'<ul>'.$chilren.'</ul></li>';
            }
            $link .= $this->links_siblings_after($map);
        }
        if ($level == 4) {
            $link .= $this->links_parent_ancestors($map);
            $link .= $this->links_parent_siblings_before($map);
            $link .= $this->links_parent($map);
            $link = preg_replace('/(<\/li>)$/', '', $link).'<ul>';
            $link .= $this->links_siblings_before($map);
            $link .= $this->links_self($map);
            $chilren = $this->links_children($map);
            if ($chilren) {
                $link = preg_replace('/(<\/li>)$/', '', $link).'<ul>'.$chilren.'</ul></li>';
            }
            $link .= $this->links_siblings_after($map);
            $link .= '</ul></li>';
            $link .= $this->links_parent_siblings_after($map);
        }
        $link .= '</ul>';

        if (strpos($link, 'download.html') !== false) {
            $links['download'] = $link;
        } elseif (strpos($link, 'start-testing.html') !== false) {
            $links['start_testing'] = $link;
        } elseif (strpos($link, 'support.html') !== false) {
            $links['support'] = $link;
        } elseif (strpos($link, 'todo.html') !== false) {
            $links['contribute'] = $link;
        }

        return $links;
    }

    function level_from_root($here, $map) {
        $ancestors = $map->xpath('//page[normalize-space(@here)="'.$here.'"]/ancestor::*');

        return count($ancestors);
    }
}

class PackagingSynchronisation {
    public $file;
    public $lang;
    public $content;
    
    function __construct($file, $lang="fr") {
        $this->file = $file;
        $this->lang = $lang;
        $this->content = "";
        if (file_exists($this->file)) {
            $this->content = file_get_contents($this->file);
        }
    }

    function isSynchronisable() {
        return (bool)strpos($this->content, "<synchronisation");
    }

    function result() {
        if (!$this->isSynchronisable()) {
            return false;
        } elseif (!$this->sourceRevision()) {
            return "<span style=\"color : red\"><strong>missing id</strong></span>";
        } elseif ($this->sourceRevision() > $this->lastSynchroRevision()) {
            return "<span style=\"color : red\"><strong>late</strong></span>";
        } else {
            return "<span style=\"color : green\">synchro</span>";
        }
    }
    
    function revision() {
        $matches = array();
        preg_match("/Id: [a-z_-]*\.[a-z]* ([0-9]*)/", $this->content, $matches);
        return $matches[1];    
    }
    
    function sourceLang() {
        $matches = array();
        preg_match("/synchronisation.*lang=\"([a-z]*)\"/", $this->content, $matches);
        return $matches[1];    
    }

    function sourceRevision() {
        $source_lang = $this->sourceLang();
        $source_file = str_replace("/".$this->lang."/", "/".$source_lang."/", $this->file);
        if (file_exists($source_file)) {
            $source = new PackagingSynchronisation($source_file, $source_lang);
            return $source->revision();
        }
        return false;
    }
    
    function lastSynchroRevision() {
        $matches = array();
        preg_match("/synchronisation.*version=\"([0-9]*)\"/", $this->content, $matches);
        return $matches[1];    
    }
}
?>