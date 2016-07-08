<?php include('./assets/works/main.php'); ?>
<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <!-- Title & Description -->
        <title><?php echo($site['title']); ?> | <?php echo($site['tagline']); ?></title>
        <meta name="description" content="A minimalist template for your video channel.">
        
        <!-- Viewport Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
        
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="assets/styles/normalize.css">
        <link rel="stylesheet" type="text/css" href="assets/styles/main.css">
        <link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
        <link rel="stylesheet" type="text/css" href="assets/styles/animations.css">
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="" href="assets/images/favicon.png">
    </head>

    <body>
        <!-- The Header -->
        <header class="row <?php if($header['logo']) { ?>logo<?php } else { ?>title<?php } ?><?php if($site['tagline']) { ?> tagline<?php } ?>">
            <div class="content">
                <!-- The Intro -->
                <div class="intro">
                    <?php if($header['logo']) { ?>
                    <img src="assets/images/<?php echo($site['logo']); ?>">
                    <?php } else { ?>
                    <h1><?php echo($site['title']); ?></h1>
                    <?php } ?>
                    <?php if($site['tagline']) { ?>
                    <blockquote><?php echo($site['tagline']); ?></blockquote>
                    <?php } ?>
                </div>

                <!-- Content Panels Links -->
                <nav>
                    <?php if($panel['about']) { ?><a class="open" href="#about">About</a><?php } ?>
                    <?php if($panel['contact']) { ?><a class="open" href="#contact">Contact</a><?php } ?>
                    <?php if($panel['news']) { ?><a class="open" href="#news">News</a><?php } ?>
                </nav>
            </div>
        </header>
        
        <?php if($panel['about']) { ?>
        <!-- The About Panel -->
        <section class="panel copy closed" id="about">
            <a class="icon close stop" href="#about"></a>
            
            <div class="content">
                <?php if($about['profile_image']) { ?><img class="profile" src="assets/images/<?php echo($about['profile']); ?>"><?php } ?>
                <h2><?php echo($about['title']); ?></h2>
                <p><?php echo($about['text']); ?></p>
                <?php if($about['signature_image']) { ?><img class="signature" src="assets/images/<?php echo($about['signature']); ?>"><?php } ?>
            </div>
        </section>
        <?php } ?>
        
        <?php if($panel['contact']) { ?>
        <!-- The Contact Panel -->
        <section class="panel copy closed" id="contact">
            <a class="icon close stop" href="#contact"></a>
            
            <div class="content">
                <h2><?php echo($contact['title']); ?></h2>
                <p><?php echo($contact['text']); ?></p>
                
                <!-- The Contact Form -->
                <form class="row" id="contact-form" action="assets/works/post-mail.php" method="post">
                    <div class="form-message"></div>
                
                    <div class="row">
                        <input type="text" name="name" id="name" placeholder="Your Name">
                    </div>
                    
                    <div class="row">
                        <input type="email" name="email" id="email" placeholder="Your Email">
                    </div>
                    
                    <div class="row">
                        <textarea name="message" id="message" placeholder="Your Message ..."></textarea>
                        <p class="characters"></p>
                    </div>
                    
                    <button type="submit" name="contact" value="contact">Submit</button>
                </form>
            </div>
        </section>
        <?php } ?>
        
        <?php if($panel['news']) { ?>
        <!-- The News Panel -->
        <section class="panel copy closed" id="news">
            <a class="icon close stop" href="#news"></a>
            
            <div class="content">
                <h2><?php echo($news['title']); ?></h2>
                <p><?php echo($news['text']); ?></p>

                <!-- The MailChimp Form -->
                <form class="row" id="mailchimp-form" action="assets/works/post-subscribe.php" method="post">
                    <div class="form-message"></div>

                    <div class="row">
                        <input type="text" name="mc-name" id="mc-name" placeholder="Your Name">
                    </div>

                    <div class="row">
                        <input type="email" name="mc-email" id="mc-email" placeholder="Your Email">
                    </div>

                    <button type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </section>
        <?php } ?>

        <!-- Episodes -->
        <section class="row" id="episodes">
            <div class="content">
                <?php echo($content); ?>
            </div>
        </section>

        <!-- The Video Panel -->
        <section class="panel media closed" id="video">
            <a class="icon close stop" href="#video"></a>
            
            <div class="content">
                <div class="video">
                </div>
            </div>
        </section>

        <!-- The More Panel -->
        <section class="panel copy closed" id="more">
            <a class="icon close stop" href="#more"></a>
            
            <div class="content">
            </div>
        </section>

        <!-- The Footer -->
        <footer class="row">
            <div class="content">
                <?php if($footer['text']) { ?><h3><?php echo($footer['text']); ?></h3><?php } ?>
                
                <!-- Social Linkage -->
                <nav>
                    <?php if($social['twitter']) { ?><a class="twitter" href="http://twitter.com/<?php echo($social['twitter']); ?>" target="_blank">Twitter</a><?php } ?>
                    <?php if($social['instagram']) { ?><a class="instagram" href="http://instagram.com/<?php echo($social['instagram']); ?>" target="_blank">Instagram</a><?php } ?>
                    <?php if($social['facebook']) { ?><a class="facebook" href="http://facebook.com/<?php echo($social['facebook']); ?>" target="_blank">Facebook</a><?php } ?>
                </nav>
            </div>
        </footer>

        <!-- Required Scripts -->
        <script type="text/javascript" src="assets/scripts/jquery.js"></script>
        <script type="text/javascript" src="assets/scripts/limit.js"></script>
        <script type="text/javascript" src="assets/scripts/main.js"></script>
    </body>
</html>