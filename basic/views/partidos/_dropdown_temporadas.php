<?php foreach ($temporadas as $temporada): ?>
    <option value="<?= $temporada->id ?>"><?= $temporada->texto_de_titulo ?></option>
<?php endforeach; ?>