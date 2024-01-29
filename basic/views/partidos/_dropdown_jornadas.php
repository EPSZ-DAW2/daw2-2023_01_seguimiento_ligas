<?php foreach ($jornadas as $jornada): ?>
    <option value="<?= $jornada->id ?>"><?= $jornada->numero ?></option>
<?php endforeach; ?>