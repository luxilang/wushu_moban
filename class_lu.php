<?php
class lupage
{
    var $_perPage; //每一页记录数
    var $_totalItems; //总记录数
    var $_totalPages; //总共页数
    var $_currentPage; // 当前页序号
    var $_listStart; //当前头条记录ID
    var $_listEnd; //当前最后条记录ID
    var $_pageStart; //第一页
    var $_pageEnd; //最后页
    var $_listPage; //循环显示当前分页列表
    var $_pageData; //当前要显示的记录
    var $_linkData; //页面传递的变量
    var $_startId ; //从数据库读出的启始id
    var $_page_link_css_class = 'class="c_999"';
    var $_page_curr_selected_css_class = 'class="c_ff78001"';
    
    function lupage($_totalItems, $_perPage, $_linkData,$mid_page_str = 10)
    {
		
        $this->_currentPage  =  (empty($this->_currentPage)) ?  max((int)@$_GET['pageId'], 1) : $this->_currentPage ;
        $this->_perPage = $_perPage; //每一页记录数
        $this->_totalItems = $_totalItems; //总记录数
        $this->_totalPages = ceil($this->_totalItems / $this->_perPage); //总页数
        $this->_linkData = $_linkData; //传递的变量
        $this->_listStart = ($this->_currentPage - 1) * $this->_perPage + 1; //当前头条记录ID
        $this->_listEnd = ($this->_currentPage != $this->_totalPages) ? $this->_currentPage * $this->_perPage : $this->_totalItems; //当前最后条记录ID
        $this->_startId = $this->_listStart -1; //从数据库读出的启始id
        $this->queindexphp = true;
        $this->urlphpself = (!$this->queindexphp) ? $_SERVER['PHP_SELF'] : '';
        $this->mid_page_str =  ($mid_page_str%2==0)  ? $mid_page_str : $mid_page_str+1;
    }
    function startId() // 从数据库读出的启始id
    {
        return $this->_startId;
    }
    function totalItems() // 总记录数
    {
        return $this->_totalItems;
    }
    function totalPages() // 总页数
    {
        return $this->_totalPages;
    }
    function listStart() // 当前头条记录ID
    {
        return $this->_listStart;
    }
    function listEnd() // 当前最后条记录ID
    {
        return $this->_listEnd;
    }
    function currentPage() // 当前页
    {
        return $this->_currentPage;
    }
    function pageStart() // 第一页
    {
		
		
		if (($this->_currentPage < 6) ) {
			return $this->_pageStart = "";
		}
		else{
			return $this->_pageStart = "<a {$this->_page_link_css_class} href=" . $this->urlphpself . ($this->_linkData) . "&pageId=1>...1</a>";
			
		}
         
    }
    function pageEnd() // 最后页
    {
		$shenglue_ =($this->_currentPage > $this->_totalPages-6 ) ? '' : '...'.$this->_totalPages;
		if (!empty($shenglue_)) {
			  return $this->_pageEnd = "<a {$this->_page_link_css_class} href=" . $this->urlphpself . ($this->_linkData) . "&pageId=" . $this->_totalPages . ">{$shenglue_}</a>";
		}
  
    }
    function upPage() // 上一页
    {
        if ($this->_currentPage > 1 and $this->_currentPage <= $this->_totalPages)
        {
            $up = $this->_currentPage-1;
            return $this->_upPage = "<a {$this->_page_link_css_class}  href=" . $this->urlphpself . ($this->_linkData) . "&pageId=" . $up . ">上一页</a>";
        }
    }
    function downPage() // 下一页
    {
        $down = $this->_currentPage + 1;
        if ($this->_currentPage < $this->_totalPages)
            return $this->_downPage = "<a {$this->_page_link_css_class}  href=" . $this->urlphpself . ($this->_linkData) . "&pageId=" . $down . ">下一页</a>";
    }
    function listPage() // 循环显示当前分页列表
    {
        
        if ($this->_currentPage <= ($this->mid_page_str/2) and $this->_currentPage != "")
        {
            $start = 1;
            if ($this->_totalPages < $this->mid_page_str)
            { 
                $end = $this->_totalPages;
            }
            else
            { 
                $end = $this->mid_page_str;
                
            }
        } 
        elseif (($this->_currentPage + ($this->mid_page_str/2)) > $this->_totalPages)
        {
            $start = $this->_currentPage - ($this->mid_page_str/2);
            $end = $this->_totalPages;
        }
        else
        {
            $start = $this->_currentPage - ($this->mid_page_str/2 -1);
            $end = $this->_currentPage + ($this->mid_page_str/2);
        }
        
        for($i = $start; $i <= $end; $i++)
        {
             if($this->_currentPage == $i)
             {
             
                 $this->_listPage .=   "<a  href=" . $this->urlphpself . ($this->_linkData) . "&pageId=" . $i . " {$this->_page_curr_selected_css_class} >" . $i . "</a> ";
             }
             else
             {
                 $this->_listPage .= "<a {$this->_page_link_css_class} href=" . $this->urlphpself . ($this->_linkData) . "&pageId=" . $i . ">" . $i . "</a> ";
             }
        }
        return $this->_listPage;
    }
    function jumpPage() // 跳转
    {
        
        $this->_jumpPage = "跳转 <select name='pageId' style='height=14px' onchange=\"location='" . $this->urlphpself . ($this->_linkData) . "&pageId='+this.value;\">"; //页面跳转
        for($i = 1; $i <= $this->_totalPages; $i++)
        {
            $selected = ($i == $this->_currentPage) ? "selected" : '';
            $this->_jumpPage .= "<option value='$i' $selected>$i</option>";
            unset($selected);
        }
        return $this->_jumpPage .= "</select> 页 ";
        
    }
    function out_page()
    {
        $upPage = $this->upPage();$upPage =  (empty($this->_totalItems)) ? '' : $upPage;
        $listPage = $this->listPage();$listPage =  (empty($this->_totalItems))  ? '' : $listPage;
        $downPage = $this->downPage();$downPage =  (empty($this->_totalItems))  ?  '' : $downPage;
        $pageStart = $this->pageStart() ; $pageStart = (empty($this->_totalItems))  ?  '': $pageStart; 
        $pageEnd = $this->pageEnd() ; $pageEnd = (empty($this->_totalItems))  ?  '': $pageEnd; 
        return $upPage."&nbsp;&nbsp;".$pageStart."&nbsp;&nbsp;".$listPage."&nbsp;&nbsp;".$pageEnd."&nbsp;&nbsp;".$downPage."&nbsp;&nbsp".$this->jumpPage()."&nbsp;&nbsp".'共'.$this->_totalItems.'条';
    }
    function mobile_out_page()
    {
        $upPage = $this->upPage();$upPage =  (empty($this->_totalItems)) ? '' : $upPage;
        $listPage = $this->listPage();$listPage =  (empty($this->_totalItems))  ? '' : $listPage;
        $downPage = $this->downPage();$downPage =  (empty($this->_totalItems))  ?  '' : $downPage;
        $pageStart = $this->pageStart() ; $pageStart = (empty($this->_totalItems))  ?  '': $pageStart; 
        $pageEnd = $this->pageEnd() ; $pageEnd = (empty($this->_totalItems))  ?  '': $pageEnd; 
        return $this->jumpPage()."&nbsp;&nbsp".'共'.$this->_totalItems.'条';
    }
}

?>
