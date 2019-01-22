<header class="header">
    <h1 style="color:#3a4e3d;">todos</h1>
    <form id="create-todo" method="post" action="todos">
      <input name="title" class="new-todo" placeholder="What needs to be done?" autofocus>
    </form>
</header>

<section class="main">
    <form action="todos/toggle-all" method="POST" name="toggle-all">
        <input id="toggle-all" class="toggle-all" type="checkbox" name="checking-all" onChange = "submit();" 
         value="<?= (count(array_filter($todos, function($todo) { return $todo['completed'] == false; })) !==0 ? 1 : 0) ?>">
        <label for="toggle-all">Mark all as complete</label>
    </form>
</section>