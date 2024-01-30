<?php foreach ($equipos as $equipo): ?>
    <option value="<?= $equipo->id ?>"><?= $equipo->nombre ?></option>
<?php endforeach; ?>