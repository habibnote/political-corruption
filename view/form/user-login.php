<form id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login' ) ); ?>" method="post">
    
    <p>
        <label for="user_login"><?php _e( 'Username or Email' ); ?></label>
        <input type="text" id="user_login" name="log" required>
    </p>
    <p>
        <label for="user_pass"><?php _e( 'Password' ); ?></label>
        <input type="password" id="user_pass" name="pwd" required>
    </p>
    <p>
        <input type="checkbox" name="rememberme" id="rememberme">
        <label for="rememberme"><?php _e( 'Remember Me' ); ?></label>
    </p>
    <p>
        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="<?php esc_attr_e( 'Log In' ); ?>">
    </p>
    <p>
        <a href="<?php echo wp_lostpassword_url(); ?>"><?php _e( 'Lost your password?' ); ?></a>
    </p>
</form>