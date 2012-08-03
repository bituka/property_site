<div id="header-container">
    <header class="wrapper">
        <h1 id="title">Logo here</h1>
        <nav>
            <ul>
                <li><a href="#"><strong>Home</strong></a></li>
                <li><a href="#">navigation</a></li>
                <li><a href="#">links</a></li>
            </ul>
        </nav>
    </header>
</div>
<div id="main" class="wrapper">
    <aside>
        <?php if ($this->session->userdata('is_logged_in') == true) { ?>
            <h5>Hi <?php echo $this->session->userdata('email_add'); ?>!</h5>
            <?php echo anchor('login/logout', 'Logout'); ?>

            <?php
        } else {
            echo anchor('login', 'Login');
        }
        ?>

    </aside>

    <article>
        <header>
            <h2>Your article heading</h2>
            <div id="slideshow">
    <div id="slidesContainer">
     <div id="slides">
    <img alt="Glendatronix" class="show" src="../img/img_slide_01.jpg" />
    <img alt="Darth Fader" src="../img/img_slide_02.jpg" />
    <img alt="Beau Dandy" src="../img/img_slide_03.jpg" />
    </div>
    </div>
  </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra. Pellentesque auctor neque quis nisl lacinia id rutrum lacus venenatis.</p>
        </header>

        <h3>A smaller heading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra. Pellentesque auctor neque quis nisl lacinia id rutrum lacus venenatis.</p>	
        <h3>A smaller heading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor. Etiam ullamcorper lorem dapibus velit suscipit ultrices. Proin in est sed erat facilisis pharetra. Pellentesque auctor neque quis nisl lacinia id rutrum lacus venenatis.</p>
        <footer>
            <h3>About the author</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
        </footer>
    </article>
</div>
