<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<div id="footer">
                <div class="wrapper">
                    <span class="copyright">Fusion theme by<a href="http://www.aoemedia.de">AOE media GmbH</a> Powered by 
<a href="http://www.emlog.net" title="emlog <?php echo EMLOG_VERSION;?>">emlog</a><br />
<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
<?php doAction('index_footer'); ?></span>
                    <span class="links">
                       <a href="<?php echo BLOG_URL; ?>rss.php"><img src="<?php echo CERTEMPLATE_URL; ?>/images/rss.gif" alt="订阅Rss"/> RSS</a>                    </span>                </div>
</div><!--#footer-->
        </div><!--#root-->
        </div></div><!--end lines-->
    </body>
</html>