<form method="POST">
    <p>
        <label for="pc-email">Email</label>
        <input type="email" name="pc-email" id="pc-email">
        <p class="pc-email-avaiable">Email is Avaiable</p>
        <p class="pc-email-unaviable">Email is Exits</p>
    </p>
    <p>
        <label for="pc-phone">Phone</label>
        <input type="text" name="pc-phone" id="pc-phone">
    </p>
    <p>
        <label for="pc-username">Username</label>
        <input type="text" name="pc-username" id="pc-username">
        <p class="pc-username-avaiable">Username is Avaiable</p>
        <p class="pc-username-unaviable">Username is Exits</p>
    </p>
    <p>
        <label for="pc-password">Password</label>
        <input type="password" name="pc-password" id="pc-password">
        <p class="pc-password-invalid">Password should be at least 6 character</p>
    </p>
    <p>
        <?php 
            wp_nonce_field( 'pc_nonce' );
        ?>
    </p>
    <p>
        <button type="submit" name="pc-register">Register</button>
    </p>
</form>