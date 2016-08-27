<?php defined('_JEXEC') or die; 
// Add JavaScript Frameworks -- pulls in Bootstrap, jQuery in no conflict mode 
 JHtml::_('bootstrap.framework'); 
// Load Bootstrap CSS 
 JHtmlBootstrap::loadCss($includeMaincss = true); 
?> 
<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
		<jdoc:include type="head" /> 
		<link href="templates/marniescully/css/default.css" rel="stylesheet" type="text/css"> 
		<!--[if lt IE 9]> 
			<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script> 
		<![endif]-->
	</head>
	
	<body>
   		<div id="pageOuter" class="row-fluid">
          <header class="row-fluid">
              <div class="span12">
                  <a href="http://joomla.vfw.marniescully.biz/joomla/"><img src="templates/marniescully/images/flag.png" alt="Palmerton, PA United Veterans Organization" class="pull-left hidden-phone" id="flag"/></a> 
                  <h1>
                        Palmerton, Pa<br>
                        United <br>
                        Veterans<br> 
                        Organization
                  </h1>
                  <img class="hidden-phone hidden-tablet" src="templates/marniescully/images/logoLegionEmblem.png" alt="American Legion Logo" id="legionLogo"/>
                  <img class="hidden-phone hidden-tablet" src="templates/marniescully/images/vfw.jpg" alt="VFW Logo" id="vfwLogo"/>
             </div>
          </header>
          
          <div id="navigation" class="row-fluid">
              <nav class="span12 navbar">
                  <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                         <jdoc:include type="modules" name="nav" style="none" />
                        </div>
                    </div>
                </div>
              </nav>
          </div>   
          
          <div id="mainContentRow" class="row-fluid">
              
          <?php if (($this->countModules('left_3')) && ($this->countModules('right_3'))): ?>
              <div id="leftCol" class="span3">
                  <!-- This is where the random graphic appears on SOME pages -->
                  <jdoc:include type="modules" name="left_3" style="html5"/>
              </div>
                    
              <div id="mainCol" class="span6">
                   <!-- This is the column where main content appears as well as components -->
                  
                  <?php if ($this->countModules('breadcrumbs')): ?>  
                      <div class="row-fluid">
                          <div id="BreadCrumbs" >
                              <!-- This is where the breadcrumbs appears on SOME pages -->
                              <jdoc:include type="modules" name="breadcrumbs" style="html5"/>
                           </div>
                      </div>
                  <?php endif; ?>
          
                  <div class="row-fluid">
                      <div id="content" >
                          <!-- This is the row where main content appears as well as components -->
                              <jdoc:include type="message" />
                              <jdoc:include type="component" />
                       </div>
                  </div>
            </div>
              
              <div id="rightCol" class="span3 hidden-phone hidden-tablet">
                  <!-- This is where the random testimonials appears on SOME pages -->
                 <jdoc:include type="modules" name="right_3" style="html5"/>
              </div>
              
          <?php elseif (($this->countModules('left_3')) && !($this->countModules('right_3'))): ?>
              <div id="leftCol" class="span3">
              <!-- This is where the random graphic appears on SOME pages -->
              <jdoc:include type="modules" name="left_3" style="html5"/>
              </div>
                    
              <div id="mainCol" class="span9">
                 <!-- This is the column where main content appears as well as components -->
                  <?php if ($this->countModules('breadcrumbs')): ?>  
                      <div class="row-fluid">
                          <div id="BreadCrumbs" >
                              <!-- This is where the breadcrumbs appears on SOME pages -->
                              <jdoc:include type="modules" name="breadcrumbs" style="html5"/>
                           </div>
                      </div>
                  <?php endif; ?>
              
                      <div class="row-fluid">
                          <div id="content" >
                              <!-- This is the row where main content appears as well as components -->
                              <jdoc:include type="message" />
                              <jdoc:include type="component" />
                          </div>
                      </div>
              </div>
              
          <?php elseif (!($this->countModules('left_3')) && ($this->countModules('right_3'))): ?>
              <div id="mainCol" class="span9">
                  <!-- This is the column where main content appears as well as components -->
                
                  <?php if ($this->countModules('breadcrumbs')): ?>  
                      <div class="row-fluid">
                          <div id="BreadCrumbs" >
                              <!-- This is where the breadcrumbs appears on SOME pages -->
                              <jdoc:include type="modules" name="breadcrumbs" style="html5"/>
                          </div>
                      </div>
                  <?php endif; ?>
        
                  <div class="row-fluid">
                      <div id="content" >
                          <!-- This is the row where main content appears as well as components -->
                          <jdoc:include type="message" />
                          <jdoc:include type="component" />
                      </div>
                  </div>
              </div>
            
              <div id="rightCol" class="span3 hidden-phone hidden-tablet">
                  <!-- This is where the random testimonials appears on SOME pages -->
                  <jdoc:include type="modules" name="right_3" style="html5"/>
              </div>
          
          <?php elseif (!($this->countModules('left_3')) && !($this->countModules('right_3'))): ?>
              <div id="mainCol" class="span12">
                  <!-- This is the column where main content appears as well as components -->
                  <div class="row-fluid">
                      <div id="BreadCrumbs" >
                          <!-- This is where the breadcrumbs appears on SOME pages -->
                          <jdoc:include type="modules" name="breadcrumbs" style="html5"/>
                      </div>
                  </div>
        
                  <div class="row-fluid">
                      <div id="content" >
                          <!-- This is the row where main content appears as well as components -->
                          <jdoc:include type="message" />
                          <jdoc:include type="component" />
                      </div>
                  </div>
              </div>
              
          <?php endif; ?>
          
        
          </div>    
          
          <footer class="row-fluid">
              <!-- This is where the Year and Website title appear -->
              <jdoc:include type="modules" name="footer" style="html5"/>
           </footer>
      
		</div>
      
	</body>
  
</html>