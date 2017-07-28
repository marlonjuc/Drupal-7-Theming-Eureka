(function($){
    'use strict';

    Drupal.behaviors.footer = (function(){
        var _attach = function(context, settings){
            $('.footer', context)
                .once()
                .each( function(i, section){
                    (new Footer( $(section) ));
                });
        };

        return{
            attach: _attach
        }
    })();

    function Footer($section){
        this.$el = $section;
        this.dropdownHandler = new DropdownHandler(this.$el);
        this.adjustStructure = new AdjustStructure(this.$el);
        this.adjustStructure.init();
        this.bindEventsToUI();
        return this;
    }

    Footer.prototype.bindEventsToUI = function () {
        var THIS = this;
        var dropDownHandler = THIS.dropdownHandler;
        var $footer = THIS.$el;
        var dropdownAboutMenuTrigger = $footer.find('.about-menu-menu .dropdown');
        var dropdownPartnerMenuTrigger = $footer.find('.partner-menu-menu .dropdown');
        var dropDownTriggerLogo = $footer.find('.footer-dropdown-trigger__logo')
        var newsletterModal = $footer.find('.trigger-newsletter');

        newsletterModal.on('click',function(e) {
            e.preventDefault();
            Drupal.behaviors.newsletterModal.open();
        });

        dropdownAboutMenuTrigger.on('click',function(e) {
            e.preventDefault();
            dropDownHandler.showAboutMenu($(this));
        });

        dropdownPartnerMenuTrigger.on('click',function(e) {
            e.preventDefault();
            dropDownHandler.showPartnerMenu($(this));
        });

        dropDownTriggerLogo.on('click',function(e) {
            e.preventDefault();
            dropDownHandler.dropDownLogo($(this));
        });

        THIS.adjustStructure.onResize();
    };

    function AdjustStructure($footerContainer){
        this.$footer = $footerContainer;
        return this;
    }

    AdjustStructure.prototype.modFirstComp = function() {
        var $footer = this.$footer;

        // === Component 1
        // Social Icons
        var socialIcons = $footer
                            .find('.footer-menu-menu ul:eq(0)')
                            .addClass('footer-social-icons');

        /*socialIcons
            .find('li')
            .each(function() {
                var $this = $(this),
                    img = $this.find('img');
                $this.html(img);
            });*/

        // Highlighted links
        var hLinks = $footer.find('.footer-menu-menu ul:eq(1)');

        hLinks
            .addClass('footer-highlighted-links')
            .find('li')
            .each( function(){
                $(this).wrap('<div class="col-xs-6 col-md-100 clear-col-padding"> </div>');
            });

        hLinks.find('li:eq(0)').addClass('left-aligner_link');
        hLinks.find('li:eq(1)').addClass('right-aligner_link');
        // dropdownlinks
        return this;
    };

    AdjustStructure.prototype.modSecondComp = function() {
        var $footer = this.$footer;

        // === component 2
        var aboutMenu = $footer.find('.about-menu');
        aboutMenu.find('ul:eq(0)').addClass('about-menu-menu');
        aboutMenu.find('.dropdown-trigger__link:eq(0)').addClass('left-aligner_link');
        aboutMenu.find('.dropdown-trigger__link:eq(0) a span').removeClass('active');
        // move links to display on mobile
        var links = aboutMenu.find('.about-menu-menu_items li').clone();
        var leftContainer = $footer.find('.about-menu_items-left');
        var rightContainer = $footer.find('.about-menu_items-right');
        this.addLinksToAboutPartner(links,leftContainer,rightContainer);
        return this;
    };

    AdjustStructure.prototype.modThirdComp = function() {
        var $footer = this.$footer;

        // === component 3
        var partnerMenu = $footer.find('.partner-menu ');
        partnerMenu.find('ul:eq(0)').addClass('partner-menu-menu');
        partnerMenu.find('.dropdown-trigger__link:eq(0)').addClass('right-aligner_link');
        partnerMenu.find('.dropdown-trigger__link:eq(0) a span').removeClass('active');
        var links = partnerMenu.find('.partner-menu-menu_items li').clone();
        var leftContainer = $footer.find('.partner-menu_items-left');
        var rightContainer = $footer.find('.partner-menu_items-right');
        this.addLinksToAboutPartner(links,leftContainer,rightContainer);
        return this;
    };

    AdjustStructure.prototype.modFourthComp = function() {
        var $footer = this.$footer;
        // === component 4
        var itemsList = $footer
                            .find('.secondary-jo-brands-menu .item-list')
                            .hide();
        var itemsListLinks = itemsList.find('li');
        var containerLeft = $footer.find('.secondary-jo-brands-menu_left ul');
        var containerRight = $footer.find('.secondary-jo-brands-menu_right ul');
        var actualContainer = 'right';
        var count = 0;


        while(count < itemsListLinks.length){
            // console.log('vuelta '+count);
            if(actualContainer === 'right'){
                this.addLinkToSJO(containerLeft,itemsListLinks.eq(count++));
                this.addLinkToSJO(containerLeft,itemsListLinks.eq(count++));
                actualContainer = 'left';
            }else if(actualContainer === 'left') {
                this.addLinkToSJO(containerRight,itemsListLinks.eq(count++));
                this.addLinkToSJO(containerRight,itemsListLinks.eq(count++));
                actualContainer = 'right';
            }
        }

        containerLeft.find('a').after('<span style="float:left">&nbsp&nbsp|&nbsp&nbsp</span>');
        containerLeft.find('li').prev('span').remove();
        containerLeft.find('span').last().remove();

        containerRight.find('a').after('<span style="float:left">&nbsp&nbsp|&nbsp&nbsp</span>');
        containerRight.find('li').prev('span').remove();
        containerRight.find('span').last().remove();
        return this;
    };

    AdjustStructure.prototype.modFifthComp = function() {
        // === component 5
        this.$footer.find('.legal-menu br').remove();
        this.$footer.find('.legal-menu li').after('<span>|</span>');

        return this;
    };

    AdjustStructure.prototype.addLinkToSJO = function(container,items){
        var links = items.find('a').remove();
        var title = items;
        container.append(title);
        container.append(links);
    };

    AdjustStructure.prototype.addLinksToAboutPartner = function(links,leftContainer,rightContainer) {
        // links.addClass('left-aligner_link');
        if(links.length <= 2){
            leftContainer.append(links);
        }else {
            var leftItems = Math.ceil(links.length/2);
            for(var i = 0 ; i < leftItems; i++) {
                leftContainer.append(links[i]);
            }
            for(var i = leftItems ; i< links.length ; i++) {
                rightContainer.append(links[i]);
            }
        }
        leftContainer.find('li').removeClass('right-aligner_link').addClass('left-aligner_link');
        rightContainer.find('li').removeClass('left-aligner_link').addClass('right-aligner_link');
    };

    AdjustStructure.prototype.onResize = function() {
        var $footer = this.$footer;
        UTIL
            .media
            .on('md', function(){
                $footer.find('.secondary-jo__wrapper').css('display','block');
                $footer.find('.partner-menu_items').css('display','none');
                $footer.find('.about-menu_items').css('display','none');
                $footer.find('.dropdown-trigger__link a').removeClass('active');
            },function(){
                $footer.find('.secondary-jo__wrapper').css('display','none');
                $footer.find('.footer-dropdown-trigger__logo span').removeClass('rotate-img');
            });
    };

    AdjustStructure.prototype.init = function() {
        this.modFirstComp()
            .modSecondComp()
            .modThirdComp()
            .modFourthComp()
            .modFifthComp();

        return this;
    };

    function DropdownHandler($footerContainer){
        this.$container = $footerContainer;

        //setInitialValues
        this.partnerMenu = this.$container.find('.partner-menu');
        this.aboutMenu = this.$container.find('.about-menu');
        this.partnerMenuItems = this.$container.find('.partner-menu_items');
        this.aboutMenuItems = this.$container.find('.about-menu_items');

        this.closingTime = 400; //ms

        return this;
    }

    DropdownHandler.prototype.dropDownLogo = function(){
        var $footer = this.$container;
        UTIL
            .media
            .once('md', null , function(){
                $footer
                    .find('.secondary-jo__wrapper')
                    .slideToggle();

                $footer
                    .find('.secondary-jo-brands-menu-logo span.dropdown-arrow')
                    .toggleClass('rotate-img');

                $footer
                    .find('.secondary-jo-brands-menu-logo a')
                    .first()
                    .toggleClass('open');
            });

        return this;
    };

    DropdownHandler.prototype.showAboutMenu = function(triggerAnchor){
        var THIS = this;
        UTIL
            .media
            .once('md', null , function(){
                if(THIS.partnerMenuItems.css('display') === 'block') {
                    THIS
                        .partnerMenuItems
                        .slideUp();

                    THIS
                        .partnerMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    THIS
                        .aboutMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    setTimeout(
                        function(){
                            THIS.aboutMenuItems.slideToggle();
                        }
                        ,THIS.closingTime
                    );

                } else {
                    THIS
                        .aboutMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    THIS
                        .aboutMenuItems
                        .slideToggle();
                }
            });

        return THIS;
    };

    DropdownHandler.prototype.showPartnerMenu = function() {
        var THIS = this;
        UTIL
            .media
            .once('md', null , function(){
                if(THIS.aboutMenuItems.css('display') === 'block') {

                    THIS
                        .aboutMenuItems
                        .slideUp();

                    THIS
                        .partnerMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    THIS
                        .aboutMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    setTimeout(
                        function(){
                            THIS.partnerMenuItems.slideToggle();
                        }
                        , THIS.closingTime
                    );

                }else {
                    THIS
                        .partnerMenu
                        .find('.dropdown-trigger__link a ')
                        .toggleClass('active');

                    THIS
                        .partnerMenuItems
                        .slideToggle();
                }

                THIS
                    .$container
                    .find('.about-menu_items')
                    .slideUp();
            });

        return THIS;
    };

})(jQuery);