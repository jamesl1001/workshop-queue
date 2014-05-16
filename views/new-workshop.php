<header>
    <div class="centre">
        <img src="/img/new.png" alt="New" id="header-img"/>
        <div id="header-info">
            <h1 id="header-title">Create A New Workshop</h1>
            <p>Lecturers can use this form to create new workshops.</p>
        </div>
    </div>
</header>

<div id="main">
    <div class="centre">
        <form action="" method="post">
            <label for="new-workshop-module-code">Module code</label>
            <input type="text" name="new-workshop-module-code" autofocus required/>

            <label for="new-workshop-module-name">Module name</label>
            <input type="text" name="new-workshop-module-name" required/>

            <label for="new-workshop-type">Type</label>
            <select name="new-workshop-type" required>
                <option disabled></option>
                <option value="3d">3D</option>
                <option value="android">Android</option>
            </select>

            <label for="new-workshop-lecturer">Lecturer name</label>
            <input type="text" name="new-workshop-lecturer" required/>

            <label for="new-workshop-date">Workshop date</label>
            <input type="date" name="new-workshop-date" required/>

            <label for="new-workshop-room">Room</label>
            <input type="text" name="new-workshop-room" required/>

            <label for="new-workshop-time">Approx. wait time per student (mins)</label>
            <input type="number" name="new-workshop-time" required/>

            <input type="submit" name="new-workshop-submit" value="Create"/>
        </form>

        <?php
        require_once('php/Admin.php');

        if(!empty($_POST['new-workshop-submit'])) {
            if(!empty($_POST['new-workshop-module-code']) && !empty($_POST['new-workshop-module-name']) && !empty($_POST['new-workshop-type']) && !empty($_POST['new-workshop-lecturer']) && !empty($_POST['new-workshop-date']) && !empty($_POST['new-workshop-room']) && !empty($_POST['new-workshop-time'])) {
                $workshopId = Admin::newWorkshop($_POST['new-workshop-module-code'], $_POST['new-workshop-module-name'], $_POST['new-workshop-type'], $_POST['new-workshop-lecturer'], $_POST['new-workshop-date'], $_POST['new-workshop-room'], $_POST['new-workshop-time']);
                header("location: /workshop/$workshopId");
            } else {
                echo '<p class="error">Please complete all the fields.</p>';
            }
        }
        ?>
    </div>
</div>