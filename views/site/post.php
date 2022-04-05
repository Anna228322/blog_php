<?php

use yii\helpers\Url;

?>
<div class="main-content">
    <div class="container">
        <div class="row">
                <?=$this->render('/partial/sidebar', [
                    'recent'=>$recent
                ]);?>
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <h3 class="widget-title text-uppercase text-center" style="padding-top:10px">Post</h3>
                        <a href="blog.html"><img src="<?=$article->getImage();?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h1 class="entry-title"><a href="blog.html"><?=$article->title;?></a></h1>
                        </header>
                        <div class="entry-content">
                            <?=$article->content;?>
                        </div>
                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">By <?=$article->author->name?> <?=$article->getDate();?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="<?=Url::toRoute('/site/fake');?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="<?=Url::toRoute('/site/fake');?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="<?=Url::toRoute('/site/fake');?>"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>


        </div>
    </div>
</div>