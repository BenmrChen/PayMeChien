<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <header id="header">
{{--        @if(session()->has('user_id'))--}}
{{--            <a href="/user/auth/sign-out">登出</a>--}}
{{--            <a href="/">首頁</a>--}}
{{--        @else--}}
{{--            <a href="/user/auth/sign-in">登入</a>--}}
{{--            <a href="/user/auth/sign-up">註冊</a>--}}
{{--            <a href="/">首頁</a>--}}
{{--        @endif--}}
    <div class="container">
      <nav>
        <div id="logo">
{{--          <a href="">--}}
{{--            <img src="images/logo2.jpg" alt="logo" style="width: 30%">--}}
{{--          </a>--}}
        </div>
      
        <ul class="nav" >
          <li><a href="#home">home</a></li>
          <li><a href="#about">about</a></li>
          <li><a href="#service">service</a></li>
          <li><a href="#portfolio">portfolio</a></li>
          <li><a href="#contact">contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <section class="home_bg" id="home">
    <div class="overlay"></div>
    <div class="container_table">
      <div class="container_table_cell">
        <h2>hello! I am Benmr</h2>

        <div class="social_icons">
            <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-github-alt" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-skype" aria-hidden="true"></i></a>
            <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
         </div>
      </div>
    </div>
  </section>
 <section class="about_me clearfix" id="about">
    <div class="container">
      <h2>about me</h2>

      <div class="summary">
        <div class="col-left">
          <div class="avatar">
            <img src="images/me.jpg" alt="avatar">
          </div>
        </div>

        <div class="col-right">
          <div class="personal-info">
            <h3>hello!</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio fugit maiores facere consequatur omnis ipsa recusandae possimus aspernatur totam illum aliquam excepturi beatae veniam Lorem ipsum dolor sit amet, consectetur.</p>
          </div>

          <div class="skill">
            <ul>
              <li>html5 and css3</li>
              <li>responsive website design</li>
              <li>php</li>
            </ul>
          </div>

          <div class="button-group">
            <div class="download_cv">
              <a href="">download CV</a>
            </div>
            <div class="hire_me">
              <a href="">hire me</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- What I Offer -->
  <section class="my_service clearfix" id="service">
    <div class="container">
      <h2>what i offer</h2>

      <div class="service-items">
        <div class="service-content">
          <i class="fa fa-html5" aria-hidden="true"></i>
          <h3>web design and development</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, facere.</p>
        </div>

        <div class="service-content">
          <i class="fa fa-css3" aria-hidden="true"></i>
          <h3>web design and development</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, facere.</p>
        </div>

        <div class="service-content">
          <i class="fa fa-camera-retro" aria-hidden="true"></i>
          <h3>web design and development</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, facere.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Resume -->
  <section class="resume">
    <div class="container">
      <h2>resume</h2>

      <div class="col-horizontal clearfix">
        <h3 class="resume-subtitle">education:</h3>

        <div class="col-item">
          <p class="experience-year">2001 - 2002</p>
          <div class="resume-detail">
            <h4>computer science</h4>
            <h6>google university, australia</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam atque voluptates, dignissimos, in quaerat veritatis maiores fuga dolores dolorem eius.</p>
          </div>
        </div>

        <div class="col-item">
          <p class="experience-year">2002 - 2003</p>
          <div class="resume-detail">
            <h4>google collage</h4>
            <h6>stanford university, BD</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam atque voluptates, dignissimos, in quaerat veritatis maiores fuga dolores dolorem eius.</p>
          </div>
        </div>
      </div>

      <div class="col-horizontal clearfix">
        <h3 class="resume-subtitle">experience:</h3>

        <div class="col-item">
          <p class="experience-year">2004 - 2005</p>
          <div class="resume-detail">
            <h4>themeforest company, malibug</h4>
            <h6>front end developer</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam atque voluptates, dignissimos, in quaerat veritatis maiores fuga dolores dolorem eius.</p>
          </div>
        </div>

        <div class="col-item">
          <p class="experience-year">2005 - 2007</p>
          <div class="resume-detail">
            <h4>google company, australia</h4>
            <h6>wordpress developer</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam atque voluptates, dignissimos, in quaerat veritatis maiores fuga dolores dolorem eius.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Quote -->
  <section class="quotes">
    <div class="overlay"></div>
    <div class="container">
      <div class="quote-inner">
        <h3>Let's work together!</h3>
        <p>I am available for freelance projects</p>
        <a href="#">get quotes</a>
      </div>
    </div>
  </section>
  <section class="works" id="portfolio">
    <h2>latest work</h2>
    <div class="work-items clearfix">
      <div class="col-work">
        <a href="/">
          <img src="images/portfolio/work-1.jpg" alt="portfolio-1">
        </a>
      </div>
            <div class="col-work">
        <a href="images/portfolio/work-2.jpg"> 
          <img src="images/portfolio/work-2.jpg" alt="portfolio-1">
        </a>
      </div>
            <div class="col-work">
        <a href="images/portfolio/work-3.jpg"> 
          <img src="images/portfolio/work-3.jpg" alt="portfolio-1">
        </a>
      </div>
            <div class="col-work">
        <a href="images/portfolio/work-4.jpg"> 
          <img src="images/portfolio/work-4.jpg" alt="portfolio-1">
        </a>
      </div>
            <div class="col-work">
        <a href="images/portfolio/work-5.jpg"> 
          <img src="images/portfolio/work-5.jpg" alt="portfolio-1">
        </a>
      </div>
            <div class="col-work">
        <a href="images/portfolio/work-6.jpg"> 
          <img src="images/portfolio/work-6.jpg" alt="portfolio-1">
        </a>
      </div>
    </div>
  </section>
  <section class="contact" id="contact">
    <div class="container">
      <h2>get in touch</h2>

      <div class="contact-form">
        <form action="">
          <div class="form-input">
           <input type="text" name="name" class="form-style" placeholder="input your name" required> 
          </div>

          <div class="form-input">
            <input type="email" name="email" class="form-style" placeholder="enter your email" required>
          </div>
          
          <div class="form-input">
            <textarea name="textarea" id="message" cols="30" rows="10" required></textarea>
          </div>

          <div class="form-submit">
            <input type="submit" name="submit" value="submit">
          </div>

        </form>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <footer id="footer">
    <div class="container">
      <div class="footer-content">
        <p>&copy; 2017 ALPHA Camp | All Rights Reserved.</p>
        <div class="footer-social-icon">
          <ul>
            <li>
              <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-github-alt" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-skype" aria-hidden="true"></i></a>
              <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>