<div class="container-fluid">
    <div class="section-full-width">
        <div class="section-padding">
    
            <?php foreach ($rows as $id => $row): ?>
                <div class="row"> <!-- Wrapper first 4 components -->
        
                    <!-- Component 1 -->
                    <div class="content footer-menu col-xs-12 col-md-20 col-md-links">
                        <div class="footer-menu__site-logo">
                            <?php
                                $logopublic = theme_get_setting('logo_path');
                                $logo = null;
                                if(!empty($logopublic)){
                                    $logo = file_create_url($logopublic);
                                }
                                if (empty($logo)) {
                                    print '<img src="' .  base_path()  .  path_to_theme() . '/logo.png" alt="'.variable_get('site_name', "Default site name").'" />';
                                }
                                else {
                                    print '<img src="' . $logo . '" alt="'.variable_get('site_name', "Default site name").'" />'; // this prints out path to you uploaded logo
                                }
                            ?>
                        </div>
        
                        <div class="menu footer-menu-menu">
                            <?php print $view->render_field('field_social_links', $id);?>
                            <?php print $view->render_field('field_highlighted_links', $id);?>
                        </div>
                    </div>
                    <!-- end Component 1 -->
        
                    <!-- Component 2 -->
                    <div class="content about-menu col-xs-6 col-md-20 col-md-links clear-col-padding">
                        <?php print $view->render_field('field_about_menu_link', $id);?>
                    </div>
                    <!-- end Component 2 -->
        
                    <!-- Component 3 -->
                    <div class="content partner-menu col-xs-6 col-md-20 col-md-links clear-col-padding">
                        <?php print $view->render_field('field_partner_menu_link', $id);?>
                    </div>
        
                    <div class="about-menu_items col-xs-12">
                        <div class="row">
                            <div class=" col-xs-6 col-md-20 clear-col-padding">
                                <ul class="about-menu_items-left"></ul>
                            </div>
                            <div class=" col-xs-6 col-md-20 clear-col-padding">
                                <ul class="about-menu_items-right"></ul>
                            </div>
                        </div>
                    </div>
        
                    <div class="partner-menu_items col-xs-12">
        
                        <div class="row">
                            <div class=" col-xs-6 col-md-20 clear-col-padding">
                                <ul class="partner-menu_items-left"></ul>
                            </div>
                            <div class=" col-xs-6 col-md-20 clear-col-padding">
                                <ul class="partner-menu_items-right"></ul>
                            </div>
                        </div>
        
                    </div>
        
                    <!-- Component 4 / JO Logo Dropdown-->
                    <div class="content secondary-jo-brands-menu col-xs-12 col-md-40 col-md-johnson-links">
                        <div class="secondary-jo-brands-menu-logo">
                            <a class="footer-dropdown-trigger__logo" href="#">
                                <?php print $view->render_field('field_brand_image', $id);?>
                            </a>
                            <span class="secondary-jo-brands-menu__motto"><?php print $view->render_field('field_brand_slogan', $id);?></span>
        
                            <div class="secondary-jo__wrapper row">
                                <div class="secondary-jo-brands-menu_left col-xs-6 clear-col-padding"><ul></ul></div>
                                <div class="secondary-jo-brands-menu_right col-xs-6 clear-col-padding"><ul></ul></div>
                            </div>
        
                            <?php print $view->render_field('field_secondary_jo_brand_link', $id);?>
                            <a href="#" class="footer-dropdown-trigger__logo"><span class="dropdown-arrow "></span></a>
                        </div>
                    </div>
                </div><!-- ? -->
        
                <div class="row"> <!-- wrapper 5th compnent -->
                    <!-- Component 5 -->
                    <div class="content legal-menu col-xs-12">
                        <?php print $view->render_field('field_legal_links', $id);?>
                        <?php print $view->render_field('field_legal_copy', $id);?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div> <!-- /END .section-padding --> 
    </div><!-- /END .section-full-width -->
</div> <!-- /END .container-fluid -->


