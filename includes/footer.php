<footer class="centre">
    <p class="jal"><a href="http://jalproductions.co.uk" target="_blank">&copy; JaL Productions 2014</a></p>
    <?php if(isset($_SESSION['admin']) && $_SESSION['admin']): ?>
    <p class="admin">Logged in as admin &mdash; <a href="/logout">Logout</a></p>
    <?php endif; ?>
</footer>