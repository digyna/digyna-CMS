<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_lib
{
    private $dropdownIcon = '';
    private $activeClass = 'active';
    protected $activeItem = '';
    protected $activeHref = '';
    private $arrHref = array();
    private $arrAttr = array();
    private $strAttr = array();
    public $arrData = array();
    private $result = array();

    public function __construct($config = array())
    {
        empty($config) OR $this->init($config,FALSE);
    }

    public function init($config = array(),$reset = TRUE){
        if ($reset === TRUE)
        {
            $this->dropdownIcon = '';
            $this->activeClass = 'active';
            $this->activeItem = '';
            $this->arrAttr = array();
            $this->strAttr = array();
            $this->arrData = array();
            $this->result = array();

        }

        if (isset($config['data']))
        {
            $this->setData($config['data']);
        }

        if (isset($config['ul-root']))
        {
            $this->set('ul-root', $config['ul-root']);
        }

        if (isset($config['ul']))
        {
            $this->set('ul', $config['ul']);
        }

        if (isset($config['li-parent']))
        {
            $this->set('li-parent', $config['li-parent']);
        }

        if (isset($config['a-parent']))
        {
            $this->set('a-parent', $config['a-parent']);
        }

    }

    /**
     * Set the attributes for the tag vars
     * @param string $name Var name
     * @param mixed $value Var value
     * Var names: 'ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class'
     */
    public function set($name, $value)
    {
        $tags = array('ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class');
        if (in_array($name, $tags))
        {
            $this->arrAttr[$name] = $value;
        }
    }
    /**
     * Set dropdown icon for display with submenus
     * @param string $content Content for the dropdown icon (Html code)
     */
    public function setDropdownIcon($content)
    {
        $this->dropdownIcon = $content;
    }

    /**
     * @param mixed $href (string or array)
     * @param string $activeClass (Optional) The Css class for the active item
     */
    public function setActiveItem($href, $activeClass = '')
    {
        if (is_string($href))
        {
            $this->activeItem = $href;
        } elseif (is_array($href))
        {
            $this->arrHref = $href;
        }
        
        if ($activeClass != '')
        {
            $this->activeClass = $activeClass;
        }
        $this->set('active-class', array('class' => $this->activeClass));
    }

    /**
     * @param mixed $data Data (Json string or associative array)
     */
    public function setData($data)
    {

        if (is_string($data))
        {
            $this->arrData = json_decode($data, TRUE);
        } elseif (is_array($data))
        {
            $this->arrData = $data;
        }
    }

    /**
     * Insert an item
     * @param array $item
     * @param string $before_at (Optional) The reference position for insert. The 'text' attribute
     * @param string $parent (Optional) The node parent if the insert is in a submenu. The 'text' attribute
     */
    public function insert($item, $before_at = '', $parent = '')
    {
        if ($before_at === '' && $parent === '')
        {
            $this->arrData[] = $item;
            return;
        }
        if ($parent === '')
        {
            $pos = array_search($before_at, array_column($this->arrData, 'text'));
            if ($pos !== FALSE)
            {
                array_splice($this->arrData, $pos, 0, array($item));
                return;
            }
            $this->arrData[] = $item;
        } else
        {
            $pos_parent = array_search($parent, array_column($this->arrData, 'text'));
            if ($pos_parent === FALSE)
            {
                $this->a8rrData[] = $item;
                return;
            }
            $pos = array_search($before_at, array_column($this->arrData[$pos_parent]['children'], 'text'));
            if ($pos !== FALSE)
            {
                array_splice($this->arrData[$pos_parent]['children'], $pos, 0, array($item));
                return;
            }
            $this->arrData[$pos_parent]['children'][] = $item;
        }
    }
    
    /**
     * Replace an item (find by text attribute)
     * @param array $newItem The new item
     * @param string $text The text item for search
     */
    public function replace(array $newItem, $text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        if ($pos===FALSE)
        {
            return FALSE;
        }
        $this->arrData[$pos] = $newItem;
        return TRUE;
    }
    
    /**
     * Remove an item (from top level) by text attribute
     * @param string $text Text item
     */
    public function remove($text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        if ($pos===FALSE)
        {
            return FALSE;
        }
        array_splice($this->arrData, $pos, 1);
        return TRUE;
    }
    /**
     * Get an menu item (from top level)
     * @param string $text Text menu to find
     * @return mixed Array with the item. Else not found, return NULL
     */
    public function getItem($text)
    {
        $pos = array_search($text, array_column($this->arrData, 'text'));
        return ($pos!==FALSE) ? $this->arrData[$pos] : NULL;
    }
    
    /**
     * The Html menu
     * @return string Html menu
     */
    public function html($html='')
    {
        foreach ($this->arrAttr as $tag => $attr)
        {
            $this->strAttr[$tag] = $this->buildAttributes($tag);
        }
        if (!empty($this->result))
        {
            $html=$this->buildFromResult($this->result);
        }else{
            $html=$this->build($this->arrData);
        }
        

        return $html;
    }

    /**
     * Build the menu from query database.
     * This is a alias (shorthand) for setResult() and html()
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function fromResult($result, $columnID, $columnParent)
    {
        $this->setResult($result, $columnID, $columnParent);
        return $this->buildFromResult($this->result);
    }

    /**
     * Set result from query database
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function setResult($result, $columnID, $columnParent,$isLink=TRUE)
    {
        $items = array();
        foreach ($result as $row)
        {
            if($isLink){

                $badge = (isset($row->badge)) ? $row->badge : NULL;
                $target = (isset($row->target)) ? $row->target : '_self';
                $icon = (isset($row->icon)) ? $row->icon : '';
                $items[$row->$columnParent][$row->$columnID] = array('href' => $row->href, 'text' => $row->text, 'icon' => $icon, 'target' => $target,'badge'=>$badge);
                unset($b);
            }else{

                $class = (isset($row->class)) ? $row->class : NULL;
                $input = (isset($row->input)) ? $row->input : NULL;
                $items[$row->$columnParent][$row->$columnID] = array('input' => $input, 'text' => $row->text);
            }
            
        }
        $this->result = $items;
    }

    /**
     * @param string $tag
     * @return string Tag Attributes stored
     */
    protected function getAttr($tag,$flag=FALSE)
    {
        $attr=isset($this->strAttr[$tag]) ? $this->strAttr[$tag] : '';

        if($flag){
            $attr='';
            if (isset($this->arrAttr[$tag]))
            {
                foreach ($this->arrAttr[$tag] as $name => $value)
                {
                    if($name=='class'){
                        $attr .= " {$name}=\"{$value} {$this->activeClass}\"";
                    }else{
                        $attr .= " {$name}=\"{$value}\"";
                    } 
                }
            }
        }
        
        return $attr;
    }

    /**
     * @param array $item The Item menu
     * @param boolean $isParent This item is parent?
     * @return string The Html code
     */
    protected function getTextItem($item, $isParent)
    {
        $str = (isset($item['icon'])) ? "<i class=\"{$item['icon']}\"></i> " : '';
        
            if(isset($item['input'])){
                $type = (isset($item['input']['type'])) ? "type=\"{$item['input']['type']}\" " : '';
                $name = (isset($item['input']['name'])) ? "name=\"{$item['input']['name']}\" " : '';
                $value = (isset($item['input']['value'])) ? "value=\"{$item['input']['value']}\" " : '';
                $class = (isset($item['input']['class'])) ? "class=\"{$item['input']['class']}\" " : '';
                $checked = (isset($item['input']['checked'])) ? $item['input']['checked'] : FALSE;
                $checked = ($checked==TRUE) ? 'checked' : NULL;

                $str .= "<input {$type}{$name}{$value}{$class}{$checked}/> ";
            }
        $str .= "<span class=\"text\">{$item['text']}</span> ";
        $str .= (isset($item['small'])) ? "<span class=\"small\">{$item['small']}</span> " : '';
        $str .= (isset($item['badge'])) ? "<span class=\"badge bg-orange\">{$item['badge']}</span> " : '';
        return $str;
    }

    /**
     * Renderize the tag attributes from array
     * @param string $tag The tag
     * @return string The string atributes
     */
    private function buildAttributes($tag)
    {
        $str = '';
        if (isset($this->arrAttr[$tag]))
        {
            foreach ($this->arrAttr[$tag] as $name => $value)
            {
                $str .= " {$name}=\"{$value}\"";
            }
        }
        return $str;
    }

    /**
     * Build the menu
     * @param array $array
     * @param int $depth (Optional)
     * @return string The Html code
     */
    protected function build($array, $depth = 0)
    {
        $str = ($depth === 0) ? '<ul' . $this->getAttr('ul-root') . '>' : '<ul' . $this->getAttr('ul') . '>';
        foreach ($array as $item)
        {
            $isLink = isset($item['href']);
            $isParent = isset($item['children']);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            if ($isLink)
            {
                $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
                $str .= '<li' . $this->getAttr($li) . " {$active} >";
                $str .= '<a href="' . $item['href'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
            }else{
                $str .= '<li>';
                $str .= $this->getAttr($a) . $this->getTextItem($item, $isParent);
                
            }

            if ($isParent)
            {
                $str .= $this->build($item['children'], 1);
            }
            $str .= '</li>';
            
        }
        $str .= '</ul>';
        return $str;
    }

    /**
     * Build the menu from a prepared array of Query Result
     * @param array $array Array de items
     * @param string $parent Parent ID
     * @param int $level Nivel del item
     */
    protected function buildFromResult(array $array, $parent = '0', $level = 0)
    {
        $ul = ($parent === '0') ? 'ul-root' : 'ul';
        $str = '<ul' . $this->getAttr($ul) . '>';
        foreach ($array[$parent] as $item_id => $item)
        {
            $isLink = isset($item['href']);
            $isParent = isset($array[$item_id]);
            $li = ($isParent) ? 'li-parent' : 'li';
            $a = ($isParent) ? 'a-parent' : 'a';
            if ($isLink)
            {

                $attr=$this->getAttr($li);
                $active ='';

                if (!empty($this->arrHref)){
                    foreach ($this->arrHref as $segment){
                        if($segment == $item['href']){

                            if($li=='li-parent'){
                                $attr = $this->getAttr($li,true);
                                $this->activeHref= $segment;
                            }
                            if(count($this->arrHref)==1){
                                $active=$this->getAttr('active-class');
                            }else{
                            $active = ($this->activeHref == $item['href']) ? '' : $this->getAttr('active-class'); 
                            }
                        }
                    }
                }else{
                    $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
                }

                $str .= '<li ' . $attr . " {$active} >";
                $str .= '<a href="' . $item['href'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
            }else{
                $str .= '<li>';
                $str .= $this->getTextItem($item, $isParent);
                
            }

            if ($isParent)
            {
                $str .= $this->buildFromResult($array, $item_id, $level + 2);
            }
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }
}
