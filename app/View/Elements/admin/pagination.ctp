<?php //$this->Paginator->options(array('url' => Router::getParam('pass'))); 
?>
<div class="pagermain">
					<div class="pager">
    <?php
        if ($this->Paginator->hasPrev())
            echo $this->Paginator->prev($this->Html->image('admin/prev-arrow-over.png', array('alt'=>'', 'border'=>0)), array('escape' => false), null, array('escape' => false));

        if (is_string($this->Paginator->numbers()))
            echo $this->Paginator->numbers(array('separator' => '', 'before' => '&nbsp;', 'after' => '&nbsp;'));

        if ($this->Paginator->hasNext())
            echo $this->Paginator->next($this->Html->image('admin/next-arrow-over.png', array('alt'=>'', 'border'=>0)), array('escape' => false), null, array('escape' => false));
    ?>
</div>
<div>
<div class="clr"></div>