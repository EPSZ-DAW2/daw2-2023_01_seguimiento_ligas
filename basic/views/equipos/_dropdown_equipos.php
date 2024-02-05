<select id="equipo-dropdown">
    <option value="">Seleccionar Equipo</option>
        <?php foreach ($equipos as $equipo): ?>
        <option value="<?= $equipo->id ?>"><?= $equipo->nombre ?></option>
    <?php endforeach; ?>
</select>