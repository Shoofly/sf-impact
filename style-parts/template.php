a, a:visited {
	color: <?php echo $customStyles['mainLinkColor']; ?>;
}

a:hover, a:focus {
	color: <?php echo $customStyles['mainLinkHoverColor']; ?>;
}

nav.navigation.posts-navigation {
    border-color: <?php echo $customStyles['mainLinkColor']; ?>;
}

.primary-navigation a:hover, .primary-navigation a:focus, .primary-navigation a:active {
	color: <?php echo $customStyles['secondLinkHover']; ?>;
}

.primary-navigation.toggled-on .menu-toggle {
    color: <?php echo $customStyles['mainLinkHover']; ?>;
    outline: 0;    
}
.primary-navigation a:hover, .primary-navigation a:focus, .primary-navigation a:active {
	color: <?php echo $customStyles['mainHeaderColor']; ?>;
}

#comments {
    
}

#masthead .primary-navigation a {
    color: <?php echo $customStyles['mainHeaderLinkColor']; ?>;
}

#masthead .primary-navigation a:hover, #masthead .primary-navigation a:focus, #masthead .primary-navigation a:active {
    color: <?php echo $customStyles['secondHeaderLinkColor']; ?>;    
}

.primary-navigation.toggled-on .menu-toggle {
    color: <?php echo $customStyles['mainLinkColor']; ?>;
    outline: 0;    
}

.author-info {
	background-color: white;
}

#content {
	background: whitesmoke;
	color: <?php echo $customStyles['contentTextColor']; ?>; 
}

.fimage-title-large .title {
	color: <?php echo $customStyles['fimageTitleColor']; ?>;
}

#header-surround {
	color: #f8f8f8;
}

hr {
	border-top-color: <?php echo $customStyles['borderColor']; ?>;
}

.menu-toggle {
	color: <?php echo $customStyles['mainHeaderColor']; ?>;
	background-color: transparent;
}

ol.comment-list li.bypostauthor .comment-content p {
    background-color: <?php echo $customStyles['fimageTitleColor']; ?>;    
}

#page {
	background-color: transparent;
}

.primary-menu li.current-menu-item:last-child a {
  border-bottom-color: <?php echo $customStyles['borderColor']; ?>;
}

.primary-menu > li a, .primary-menu > li a:visited {
	color: <?php echo $customStyles['dropdownMenuColor']; ?>;
}

.primary-menu > li > a:hover, .primary-menu > li > a:focus {
	color: <?php echo $customStyles['borderColor']; ?>; 
	border-bottom-color: <?php echo $customStyles['borderColor']; ?>;
}

.primary-navigation > ul .children li:last-child > a {
	border-bottom-color: <?php echo $customStyles['borderColor']; ?>;	
}

.primary-menu > li li a, .primary-menu > li li a:visited {
    background-color: <?php echo $customStyles['dropdownMenuBg']; ?>
}

.primary-menu .menu-item .menu-item a:hover, .primary-menu .menu-item .menu-item a:focus {
	background-color: <?php echo $customStyles['dropdownSubMenuBg']; ?>;
	color: <?php echo $customStyles['dropdownMenuHoverColor']; ?>; 
}
 
.primary-navigation .nav-menu {
	border-bottom-color: <?php echo $customStyles['mainHeaderColor']; ?>;
}

.primary-menu .current-menu-item a, .primary-menu .current-menu-item a:visited {
	color: <?php echo $customStyles['dropdownMenuColor']; ?>; 
}

.primary-menu .menu-item .menu-item a:hover, .primary-menu .menu-item .menu-item a:focus {
	background-color: <?php echo $customStyles['dropdownMenuHoverBg']; ?>;
	color: <?php echo $customStyles['dropdownMenuHoverColor']; ?>; 
}

.primary-navigation .nav-menu {
	border-bottom-color: rgba(255, 255, 255, 0.2);
}

.primary-navigation .primary-menu .sub-menu {
    box-shadow: <?php echo $customStyles['dropdownMenuShadow']; ?>;
}

#masthead .primary-navigation .sub-menu li a {
    color: <?php echo $customStyles['subMenuColor']; ?>;
}

#masthead .primary-navigation .sub-menu li a:hover {
    color: <?php echo $customStyles['subMenuHoverColor']; ?>;   
    background-color: <?php echo $customStyles['dropdownMenuHoverBg']; ?> 
}

.site-description {
	color: white;
}

.site-info a {
    color: <?php echo $customStyles['footerLinkColor']; ?>
}

.site-info a:hover {
        color: <?php echo $customStyles['footerLinkHoverColor']; ?>
}

.site-info span, #shoofly-footer {
    color: <?php echo $customStyles['mainAccentColor']; ?>    
}

h1, h3, h4, h5, h6 {
	color: <?php echo $customStyles['headerColor']; ?>;
}

.widget-area a, .widget-area a:visited {
	color: <?php echo $customStyles['sidebarLinkColor']; ?>;
}

.widget-area a:hover, .widget-area a:focus {
	color: <?php echo $customStyles['sidebarLinkHoverColor']; ?>;
}

.widget-footer a, .widget-footer a:visited {
	color: <?php echo $customStyles['footerLinkColor']; ?>;
}

.widget-footer a:hover, .widget-footer a:focus {
	color: <?php echo $customStyles['footerLinkHoverColor']; ?>;	
}

.entry-title, .page-title, .entry-title a, .page-title a, .entry-title a:visited, .page-title a:visited {
    color: <?php echo $customStyles['mainAccentColor']; ?>;
}

.entry-title a:hover, .page-title a:hover, .entry-title a:focus, .page-title a:focus {
    color: <?php echo $customStyles['isdebarLinkColor']; ?>;
}

@media only screen and (max-width: 782px) {
    #primary-menu a:hover, #primary-menu a:focus {
        border-bottom-color: <?php echo $customStyles['customStyles[borderColor]']; ?>;
    }
}


@media screen and (min-width: 783px) {
    .post-navigation {
        border-top-color: <?php echo $customStyles['customStyles[headerColor]']; ?>;
    }
}