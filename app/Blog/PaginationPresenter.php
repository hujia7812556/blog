<?php
/**
 * Created by PhpStorm.
 * User: jiahu
 * Date: 2015/4/14
 * Time: 18:21
 */
class PaginationPresenter extends Illuminate\Pagination\Presenter {

    public function getActivePageWrapper($text)
    {
        return '<li class="am-active"><a href="">'.$text.'</a></li>';
    }

    public function getDisabledTextWrapper($text)
    {
        return '<li class="am-disabled"><a href="">'.$text.'</a></li>';
    }

    public function getPageLinkWrapper($url, $page, $rel = null)
    {
        return '<li><a href="'.$url.'">'.$page.'</a></li>';
    }
}