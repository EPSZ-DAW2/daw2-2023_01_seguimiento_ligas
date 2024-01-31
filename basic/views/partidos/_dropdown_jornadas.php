<select id="jornada-dropdown">
    <option value="">Seleccionar Jornada</option>
        <?php foreach ($jornadas as $jornada): ?>
        <option value="<?= $jornada->id ?>"><?= $jornada->numero ?></option>
    <?php endforeach; ?>
</select>