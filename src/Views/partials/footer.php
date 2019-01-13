<footer class="footer">
<?php $count =count(array_filter($todos, function($todo) { return $todo['completed'] === "false"; })) ?>
    <span class="todo-count"><?= $count ?> item<?= $count !== 1 ? "s" : "" ?> left</span>
    <form action="todos/clear-completed" method="POST">
        <button class="clear-completed" name ="clear" onClick="submit();">Clear completed</button>
    <a href="todos/undo" style = "color:grey; text-decoration: none; left:-2em; position:relative;" name= "undo">Un select all</a>
    </form>
</footer>

</main>

<footer class="site-footer">
    <div class="small-container">
        <p class="text-center">Made by <a href="#">Ardashir, but mostly by Axel</a></p>
    </div>
</footer>

<script type="module" src="<?= $this->getScript('scripts'); ?>"></script>

</body>

</html>