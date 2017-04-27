<?php include('StringUtils.php');

echo lev('hola', 'olas');
echo '<br />';
echo lev('Tomala barbon', 'tomala barbon');

echo '<br />';
echo levNormalized(prepareString('La Tarjeta'), prepareString('tarjeta'));
echo '<br />';
echo levNormalized(prepareString("tarjeta"), prepareString("La super mega archiduper tarjeta"));
echo '<br />';
echo var_dump(compareWords(prepareString("La super mega archiduper tArgeta pocchorrosina y jamelga"), prepareString("tarjeta pochorrosa")));
